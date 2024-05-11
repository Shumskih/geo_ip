<?php

namespace Vendor\ActionFilter;

use Bitrix\Main\Event;
use Bitrix\Main\Error;
use Bitrix\Main\Loader;
use Bitrix\Main\Context;
use Bitrix\Main\EventResult;
use Bitrix\Main\LoaderException;
use Bitrix\Main\Engine\ActionFilter\Base;

/**
 * Class ModuleChecker
 * @package Vendor\ActionFilter
 *
 * Проверяет подключение модулей
 */
final class ModuleChecker extends Base
{
    private array $moduleNames;
    private Context $context;

    public function __construct(array $moduleNames)
    {
        $this->moduleNames = $moduleNames;
        $this->context = Context::getCurrent();
        parent::__construct();
    }

    /**
     * @throws LoaderException
     */
    public function onBeforeAction(Event $event): ?EventResult
    {
        foreach ($this->moduleNames as $moduleName) {
            if (!Loader::includeModule($moduleName)) {
                $this->context->getResponse()->setStatus(500);
                $this->addError(new Error('Не установлен модуль ' . $moduleName));

                return new EventResult(EventResult::ERROR, handler: $this);
            }
        }

        return null;
    }
}
