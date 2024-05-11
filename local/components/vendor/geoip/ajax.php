<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use Vendor\Email;
use Vendor\Helper;
use Bitrix\Main\Error;
use Bitrix\Main\Context;
use Bitrix\Main\Response;
use Bitrix\Main\Web\Json;
use Bitrix\Main\EventResult;
use Bitrix\Main\HttpResponse;
use Bitrix\Main\Engine\Action;
use Vendor\Service\GeoIpService;
use Vendor\ActionFilter\IpAddress;
use Bitrix\Main\Engine\ActionFilter;
use Vendor\Repository\GeoIpRepository;
use Bitrix\Main\Engine\JsonController;
use Vendor\ActionFilter\ModuleChecker;
use Vendor\Exception\GeoIpNotFoundException;

class GeoIpAjax extends JsonController
{
    protected Response|HttpResponse $response;
    protected GeoIpService $geoIpService;

    /**
     * @return array
     */
    public function configureActions(): array
    {
        return [
            'getIpInfo' => [
                'prefilters' => [
                    new ActionFilter\HttpMethod([ActionFilter\HttpMethod::METHOD_POST]),
                    new ModuleChecker(['highloadblock']),
                    new IpAddress(),
                ],
            ],
        ];
    }

    protected function processBeforeAction(Action $action): bool
    {
        $this->response = Context::getCurrent()->getResponse();
        $this->geoIpService = new GeoIpService(new GeoIpRepository(new Helper()));

        return true;
    }

    protected function processAfterAction(Action $action, $result): EventResult|array
    {
        if (isset($result['code']) && empty($result['code'])) {
            $this->response->setStatus(500);
        } elseif (!empty($result['code'])) {
            $this->response->setStatus($result['code']);
        }

        if (!empty($result['message'])) {
            $this->addError(new Error($result['message']));

            return new EventResult(EventResult::ERROR, handler: $this);
        }

        return $result ?? [];
    }

    /**
     * @param string $ip
     *
     * @return array
     * @throws Exception
     */
    public function getIpInfoAction(string $ip): array
    {
        $result = [];
        $ip = (new Helper())->cleanData($ip);

        try {
            return $this->geoIpService->getIpInfo($ip);
        } catch (GeoIpNotFoundException $e) {
            // Это пользовательские ошибки, поэтому их показываем пользователям
            $result['message'] = $e->getMessage();
            $result['code'] = $e->getCode();
        } catch (Throwable $e) {
            /*
             * Эти исключения нельзя показывать пользователям, поэтому отдаём стандартный текст, чтобы
             * исключить вывод трассировки на фронте
             * */
            $result['message'] = 'Извините! Простите! Что-то пошло не так. '
                . 'Наши специалисты уже работают над устранением проблемы.';
            $result['code'] = $e->getCode();
            $this->sendEmailOrLog(['code' => $result['code'], 'message' => $e->getMessage(), 'trace' => $e->getTrace()]);
        }

        return $result;
    }

    /**
     * @throws Exception
     */
    private function sendEmailOrLog(array $data): void
    {
        $mailResult = (new Email())->send(Json::encode($data));
        /*
         * Здесь можно проверить, если !$mailResult-isSuccess(), то залогировать тексты $e->getMessage()
         * и $mailResult->getErrorMessages()
         * */
    }
}
