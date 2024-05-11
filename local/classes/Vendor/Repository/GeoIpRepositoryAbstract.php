<?php

namespace Vendor\Repository;

use Exception;
use Vendor\Cache\TagCache;
use Bitrix\Main\Entity\DataManager;
use Bitrix\Highloadblock\HighloadBlockTable;

abstract class GeoIpRepositoryAbstract implements GeoIpRepositoryInterface
{
    private const HL_BLOCK_NAME = 'IpList';

    /**
     * Возвращает dataClass или выбрасывает исключение
     *
     * @throws Exception
     */
    protected function getDataClass(): DataManager|string
    {
        $cache = new TagCache(
            'highloadblock',
            self::HL_BLOCK_NAME,
            31536000,
            'hl_ip_list'
        );

        $cachedVar = $cache->get();
        if (is_null($cachedVar)) {
            $hlBlock = HighloadBlockTable::getList(['filter' => ['NAME' => self::HL_BLOCK_NAME]])->fetch();
            if (!$hlBlock) {
                throw new Exception('Не удалось получить хайлоадблок ' . self::HL_BLOCK_NAME);
            }
        } else {
            $hlBlock = $cachedVar;
        }

        $class = HighloadBlockTable::compileEntity($hlBlock)->getDataClass();
        if (!$class) {
            throw new Exception('Не удалось получить $dataClass');
        }

        if (is_null($cachedVar)) {
            $cache->add($hlBlock);
        }

        return $class;
    }
}
