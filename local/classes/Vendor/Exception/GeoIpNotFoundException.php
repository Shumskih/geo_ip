<?php

namespace Vendor\Exception;

use Exception;

/**
 *  GeoIpNotFoundException
 */
class GeoIpNotFoundException extends Exception
{
    public function __construct($message = 'Данные не найдены', $code = 404)
    {
        parent::__construct($message, $code);
    }
}
