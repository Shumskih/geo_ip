<?php

namespace Vendor\GeoIP\Factory;

use Vendor\GeoIP\GeoIpInterface;

interface GeoIpFactoryInterface
{
    public function getService(): GeoIpInterface;
}