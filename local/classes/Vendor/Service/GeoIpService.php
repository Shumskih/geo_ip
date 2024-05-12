<?php

namespace Vendor\Service;

use Exception;
use Vendor\GeoIP\GeoIpHelper;
use Vendor\Exception\GeoIpNotFoundException;
use Vendor\Repository\GeoIpRepositoryInterface;

class GeoIpService
{
    private GeoIpRepositoryInterface $repository;

    public function __construct(GeoIpRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Получаем данные по ip-адресу
     *
     * @throws Exception
     */
    public function getIpInfo(string $ip): array
    {
        $result = $this->getFromDb($ip);
        if (!empty($result)) {
            if (!$this->isDataExists($result)) {
                throw new GeoIpNotFoundException();
            } else {
                return $result;
            }
        }

        $geoIp = (new GeoIpHelper())->getGeoIPService($ip);
        $result = $geoIp->request();
        if (!$result) {
            $this->repository->save($ip, []);
            throw new GeoIpNotFoundException();
        }

        $result = $geoIp->getResult();
        if (!$this->isDataExists($result)) {
            $this->repository->save($ip, $result);
            throw new GeoIpNotFoundException();
        }

        $this->repository->save($ip, $result);

        return $result;
    }

    /**
     * Получаем данные по ip-адресу из хайлоадблока
     *
     * @throws Exception
     */
    private function getFromDb(string $ip): array
    {
        $object = $this->repository->get(['=UF_IP' => $ip], ['UF_CITY', 'UF_REGION', 'UF_COUNTRY']);
        if (is_null($object)) {
            return [];
        }

        return [
            'ip' => $object->getUfIp(),
            'city' => $object->getUfCity(),
            'region' => $object->getUfRegion(),
            'country' => $object->getUfCountry(),
        ];
    }

    public function isDataExists(array $data): bool
    {
        return !empty($data['city'])
            || !empty($data['region'])
            || !empty($data['country']);
    }
}
