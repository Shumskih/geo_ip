<?php

namespace Sprint\Migration;


use Throwable;
use Bitrix\Main\Diag\Debug;
use Bitrix\Main\Application;
use Bitrix\Main\DB\SqlQueryException;

class AddMail_20240510190203 extends Version
{
    protected $description = '';

    protected $moduleVersion = '4.6.1';

    /**
     * @return bool
     * @throws SqlQueryException
     */
    public function up(): bool
    {
        $conn = Application::getConnection();
        $conn->startTransaction();

        try {
            $helper = $this->getHelperManager();
            $helper->Event()->saveEventType('GEO_IP_ERROR', [
                'LID' => 'ru',
                'EVENT_TYPE' => 'email',
                'NAME' => 'Ошибка GeoIp',
                'DESCRIPTION' => '',
                'SORT' => '150',
            ]);
            $helper->Event()->saveEventMessage('GEO_IP_ERROR', [
                'LID' => [
                    0 => 's1',
                ],
                'ACTIVE' => 'Y',
                'EMAIL_FROM' => '#DEFAULT_EMAIL_FROM#',
                'EMAIL_TO' => 'it@geoip.com',
                'SUBJECT' => 'Ошибка GeoIP',
                'MESSAGE' => 'Произошла ошибка при работе GeoIp:
#TEXT#',
                'BODY_TYPE' => 'text',
                'BCC' => '',
                'REPLY_TO' => '',
                'CC' => '',
                'IN_REPLY_TO' => '',
                'PRIORITY' => '',
                'FIELD1_NAME' => '',
                'FIELD1_VALUE' => '',
                'FIELD2_NAME' => '',
                'FIELD2_VALUE' => '',
                'SITE_TEMPLATE_ID' => '',
                'ADDITIONAL_FIELD' => [
                ],
                'LANGUAGE_ID' => 'ru',
                'EVENT_TYPE' => '[ GEO_IP_ERROR ] Ошибка GeoIp',
            ]);

            $conn->commitTransaction();
        } catch(Throwable $e) {
            Debug::dump($e->getMessage());
            $conn->rollbackTransaction();

            return false;
        }

        return true;
    }

    /**
     * @throws SqlQueryException
     */
    public function down(): bool
    {
        $conn = Application::getConnection();
        $conn->startTransaction();

        try {
            $helper = $this->getHelperManager();
            $helper->Event()->deleteEventMessage(['SUBJECT' => 'Ошибка GeoIP', 'EVENT_NAME' => 'GEO_IP_ERROR']);
            $helper->Event()->deleteEventType(['LID' => 'ru', 'EVENT_NAME' => 'GEO_IP_ERROR']);

            $conn->commitTransaction();
        } catch (Throwable $e) {
            Debug::dump($e->getMessage());
            $conn->rollbackTransaction();

            return false;
        }

        return true;
    }
}
