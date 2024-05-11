<?php

namespace Vendor\GeoIP;

/**
 * https://ip-api.com/docs/api:json
 */
class IpApiCom extends GeoIpAbstract
{
    private const URL = 'http://ip-api.com/json/#IP#';

    protected function setResult(array $data): void
    {
        $this->result = [
            'city' => $data['city'],
            'region' => $data['regionName'],
            'country' => $data['country']
        ];
    }

    public function getUrl(): string
    {
        return $this->prepareUrl(self::URL);
    }
}
