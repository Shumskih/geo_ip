<?php

namespace Vendor\GeoIP\Factory;

use Vendor\GeoIP\IpApiCom;
use Vendor\GeoIP\GeoIpInterface;

class IpApiComFactory extends GeoIpFactoryAbstract
{

    public function getService(): GeoIpInterface
    {
        return new IpApiCom($this->ip);
    }
}