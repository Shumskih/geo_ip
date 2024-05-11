<?php

namespace Vendor\GeoIP\Factory;

use Vendor\GeoIP\IpDataCo;
use Vendor\GeoIP\GeoIpInterface;

class IpDataCoFactory extends GeoIpFactoryAbstract
{
    public function getService(): GeoIpInterface
    {
        return new IpDataCo($this->ip);
    }
}