<?php

namespace Vendor\GeoIP\Factory;

abstract class GeoIpFactoryAbstract implements GeoIPFactoryInterface
{
    protected string $ip;

    public function __construct(string $ip)
    {
        $this->ip = $ip;
    }
}
