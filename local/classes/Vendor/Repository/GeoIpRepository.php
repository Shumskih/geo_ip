<?php

namespace Vendor\Repository;

use Exception;
use Vendor\Helper;
use Bitrix\Main\ORM\Query\Query;
use Bitrix\Main\ORM\Objectify\EntityObject;

class GeoIpRepository extends GeoIpRepositoryAbstract
{
    private Helper $helper;

    public function __construct(Helper $helper)
    {
        $this->helper = $helper;
    }

    /**
     * Возвращает объект записи из хайлоадблока
     *
     * setCacheTtl установлен равным 7 дням. В принципе, здесь нет смысла в setCacheTtl, потому
     * что ip-адресов огромное количество и вряд ли запросы по одному ip-адресу могут повторяться настолько часто, что
     * это оправдало бы наличие кеша, который может неоправданно разрастаться.
     *
     * @throws Exception
     */
    public function get(array $filter = [], array $select = ['*']): ?EntityObject
    {
        return (new Query($this->getDataClass()))
            ->setCacheTtl(604800)
            ->setFilter($filter)
            ->setSelect($select)
            ->exec()
            ->fetchObject();
    }

    /**
     * Сохраняет запись в хайлоадблок
     *
     * @throws Exception
     */
    public function save(string $ip, array $data): bool
    {
        $result = $this->getDataClass()::add([
            'UF_IP' => $ip,
            'UF_CITY' => $this->helper->cleanData($data['city']) ?? '',
            'UF_REGION' => $this->helper->cleanData($data['region']) ?? '',
            'UF_COUNTRY' => $this->helper->cleanData($data['country']) ?? '',
        ]);

        if (!$result->isSuccess()) {
            throw new Exception(
                'Не удалось сохранить ip адрес: ' . implode(', ', $result->getErrorMessages())
            );
        }

        return true;
    }
}
