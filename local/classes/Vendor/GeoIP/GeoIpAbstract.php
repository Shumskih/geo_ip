<?php

namespace Vendor\GeoIP;

use Bitrix\Main\Web\Json;
use Bitrix\Main\Web\HttpClient;
use Bitrix\Main\ArgumentException;

abstract class GeoIpAbstract implements GeoIPInterface
{
    protected string $ip;
    /**
     * @var array
     */
    protected array $result = [];

    public function __construct(string $ip)
    {
        $this->ip = $ip;
    }

    /**
     * Производит запрос в сервис и записывает результат в переменную $this->result
     *
     * @return bool
     * @throws ArgumentException
     */
    public function request(): bool
    {
        $httpClient = new HttpClient(['version' => HttpClient::HTTP_1_1]);
        $httpClient->get($this->getUrl());

        if (
            $httpClient->getStatus() === 200
            && $httpClient->getContentType() === 'application/json'
        ) {
            $result = Json::decode($httpClient->getResult());
            if (!$result) {
                return false;
            }

            $this->setResult($result);

            return true;
        }

        return false;
    }

    /**
     * Производит замену строки #IP# на ip-адрес в урле
     *
     * @param string $url
     * @return string
     */
    public function prepareUrl(string $url): string
    {
        return str_replace('#IP#', $this->ip, $url);
    }

    public function getResult(): array
    {
        return $this->result;
    }

    protected abstract function setResult(array $data): void;
}
