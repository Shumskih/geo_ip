<?php

namespace Vendor\Repository;

use Bitrix\Main\ORM\Objectify\EntityObject;

interface GeoIpRepositoryInterface
{
    public function get(array $filter = [], array $select = ['*']): ?EntityObject;
    public function save(string $ip, array $data): bool;
}