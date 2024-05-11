<?php

namespace Vendor\GeoIP;

/**
 * https://sypexgeo.net/ru/api/
 */
class SypexGeoNet extends GeoIpAbstract
{
    private const URL = 'https://ru.sxgeo.city/json/#IP#';

    protected function setResult(array $data): void
    {
        $this->result = [
            'city' => $data['city']['name_ru'],
            'region' => $data['region']['name_ru'],
            'country' => $data['country']['name_ru']
        ];
    }

    public function getUrl(): string
    {
        return $this->prepareUrl(self::URL);
    }
}
