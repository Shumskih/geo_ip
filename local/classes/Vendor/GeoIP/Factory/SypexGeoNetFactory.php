<?php

namespace Vendor\GeoIP\Factory;

use Vendor\GeoIP\SypexGeoNet;
use Vendor\GeoIP\GeoIpInterface;

class SypexGeoNetFactory extends GeoIpFactoryAbstract
{
    public function getService(): GeoIpInterface
    {
        return new SypexGeoNet($this->ip);
    }
}