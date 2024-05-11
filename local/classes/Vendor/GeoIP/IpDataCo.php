<?php

namespace Vendor\GeoIP;

/**
 * https://ipdata.co/
 */
class IpDataCo extends GeoIpAbstract
{
    /**
     * Ключи нельзя открыто размещать, но он бесплатный, поэтому всё равно
     */
    private const API_KEY = '8e0fcc796e902e3bf813d850363a7f9a5c696f7a259473d25d562c66';
    /**
     * Поля, которые получаем из сервиса
     */
    private const FIELDS = ['city', 'region', 'country_name'];
    /**
     * Урл запроса данных по ip-адресу
     */
    private const URL = 'https://api.ipdata.co/#IP#?api-key=#APIKEY#&fields=';

    protected function setResult(array $data): void
    {
        $this->result = [
            'city' => $data['city'],
            'region' => $data['region'],
            'country' => $data['country_name'],
        ];
    }

    public function getUrl(): string
    {
        return $this->getFields(
            str_replace(
                '#APIKEY#',
                self::API_KEY,
                $this->prepareUrl(self::URL)
            )
        );
    }

    /**
     * Добавляет к урлу поля, которые нужно получить из сервиса
     *
     * @param $url
     * @return string
     */
    private function getFields($url): string
    {
        $url .= implode(',', self::FIELDS);

        return $url;
    }
}
