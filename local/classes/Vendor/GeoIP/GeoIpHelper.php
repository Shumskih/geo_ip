<?php

namespace Vendor\GeoIP;

use Exception;
use Vendor\GeoIP\Factory\IpApiComFactory;
use Vendor\GeoIP\Factory\IpDataCoFactory;
use Vendor\GeoIP\Factory\SypexGeoNetFactory;

/**
 * Хелпер для выбора сервиса, из которого нужно получать данные по ip
 */
class GeoIpHelper
{
    /**
     * Выбор сервиса, из которого нужно получать данные.
     * В данном случае выбор написан хардкодом, в идеальном мире сервис нужно получать из конфига
     * или из настроек админки
     *
     * @param string $ip
     * @return GeoIpInterface
     * @throws Exception
     */
    public function getGeoIPService(string $ip): GeoIpInterface
    {
        $serviceCode = 'sypexGeoNet';
//        $serviceCode = 'ipApiCom';
//        $serviceCode = 'ipDataCo';

        return match ($serviceCode) {
            'ipApiCom' => (new IpApiComFactory($ip))->getService(),
            'ipDataCo' => (new IpDataCoFactory($ip))->getService(),
            'sypexGeoNet' => (new SypexGeoNetFactory($ip))->getService(),
            default => throw new Exception('Неизвестный тип сервиса: ' . $serviceCode),
        };
    }
}
