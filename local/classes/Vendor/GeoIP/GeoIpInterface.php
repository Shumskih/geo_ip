<?php

namespace Vendor\GeoIP;

interface GeoIpInterface
{
    public function request(): bool;
    public function getUrl(): string;
    public function getResult(): array;
}
