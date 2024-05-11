<?php

namespace Vendor\ActionFilter;

use Vendor\Helper;
use Bitrix\Main\Event;
use Bitrix\Main\Error;
use Bitrix\Main\Context;
use Bitrix\Main\EventResult;
use Bitrix\Main\Engine\ActionFilter\Base;

/**
 * Class IpAddress
 * @package Vendor\ActionFilter
 *
 * Проверяет корректность переданного ip-адреса
 */
final class IpAddress extends Base
{
    private Context $context;

    private const LOCAL_IP_RANGES = [
        [
            '10.0.0.0',
            '10.255.255.255'
        ],
        [
            '172.16.0.0',
            '172.31.255.255'
        ],
        [
            '192.168.0.0',
            '192.168.255.255'
        ],
        [
            '127.0.0.0',
            '127.255.255.255'
        ]
    ];

    public function __construct()
    {
        $this->context = Context::getCurrent();

        parent::__construct();
    }

    public function onBeforeAction(Event $event): ?EventResult
    {
        $request = $this->context->getRequest()->getPostList()->toArray();

        if (!isset($request['ip'])) {
            return null;
        }

        $ip = (new Helper())->cleanData($request['ip']);

        if (
            !filter_var($ip, FILTER_VALIDATE_IP)
            || $this->isLocal($ip)
        ) {
            $this->context->getResponse()->setStatus(400);
            $this->addError(new Error('Указан неверный IP-адрес'));

            return new EventResult(EventResult::ERROR, handler: $this);
        }


        return null;
    }

    /**
     * Проверяет, что адрес входит в диапазоны локальных адресов
     *
     * @param string $ip
     * @return bool
     */
    private function isLocal(string $ip): bool
    {
        $ip = ip2long($ip);

        foreach (self::LOCAL_IP_RANGES as $range) {
            if ($ip >= ip2long($range[0]) && $ip <= ip2long($range[1])) {
                return true;
            }
        }

        return false;
    }
}
