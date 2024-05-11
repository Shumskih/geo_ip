<?php

namespace Sprint\Migration;


class IpListAdd_20240508073322 extends Version
{
    protected $description = '';

    protected $moduleVersion = '4.6.1';

    private const HL_BLOCK_NAME = 'IpList';

    /**
     * @return void
     * @throws Exceptions\HelperException
     */
    public function up(): void
    {
        $helper = $this->getHelperManager();
        $hlblockId = $helper->Hlblock()->saveHlblock([
            'NAME' => self::HL_BLOCK_NAME,
            'TABLE_NAME' => 'ip_list',
            'LANG' => [
                'ru' => [
                    'NAME' => 'Список IP',
                ],
                'en' => [
                    'NAME' => 'Ip List',
                ],
            ],
        ]);
        $helper->Hlblock()->saveField($hlblockId, [
            'FIELD_NAME' => 'UF_IP',
            'USER_TYPE_ID' => 'string',
            'XML_ID' => 'UF_IP',
            'SORT' => '100',
            'MULTIPLE' => 'N',
            'MANDATORY' => 'N',
            'SHOW_FILTER' => 'S',
            'SHOW_IN_LIST' => 'Y',
            'EDIT_IN_LIST' => 'Y',
            'IS_SEARCHABLE' => 'Y',
            'SETTINGS' => [
                'SIZE' => 20,
                'ROWS' => 1,
                'REGEXP' => '',
                'MIN_LENGTH' => 0,
                'MAX_LENGTH' => 0,
                'DEFAULT_VALUE' => '',
            ],
            'EDIT_FORM_LABEL' => [
                'en' => 'IP',
                'ru' => 'IP',
            ],
            'LIST_COLUMN_LABEL' => [
                'en' => 'IP',
                'ru' => 'IP',
            ],
            'LIST_FILTER_LABEL' => [
                'en' => 'IP',
                'ru' => 'IP',
            ],
            'ERROR_MESSAGE' => [
                'en' => '',
                'ru' => '',
            ],
            'HELP_MESSAGE' => [
                'en' => '',
                'ru' => '',
            ],
        ]);
        $helper->Hlblock()->saveField($hlblockId, [
            'FIELD_NAME' => 'UF_CITY',
            'USER_TYPE_ID' => 'string',
            'XML_ID' => 'UF_CITY',
            'SORT' => '200',
            'MULTIPLE' => 'N',
            'MANDATORY' => 'N',
            'SHOW_FILTER' => 'S',
            'SHOW_IN_LIST' => 'Y',
            'EDIT_IN_LIST' => 'Y',
            'IS_SEARCHABLE' => 'Y',
            'SETTINGS' => [
                'SIZE' => 20,
                'ROWS' => 1,
                'REGEXP' => '',
                'MIN_LENGTH' => 0,
                'MAX_LENGTH' => 0,
                'DEFAULT_VALUE' => '',
            ],
            'EDIT_FORM_LABEL' => [
                'en' => 'City',
                'ru' => 'Город',
            ],
            'LIST_COLUMN_LABEL' => [
                'en' => 'City',
                'ru' => 'Город',
            ],
            'LIST_FILTER_LABEL' => [
                'en' => 'City',
                'ru' => 'Город',
            ],
            'ERROR_MESSAGE' => [
                'en' => '',
                'ru' => '',
            ],
            'HELP_MESSAGE' => [
                'en' => '',
                'ru' => '',
            ],
        ]);
        $helper->Hlblock()->saveField($hlblockId, [
            'FIELD_NAME' => 'UF_REGION',
            'USER_TYPE_ID' => 'string',
            'XML_ID' => 'UF_REGION',
            'SORT' => '300',
            'MULTIPLE' => 'N',
            'MANDATORY' => 'N',
            'SHOW_FILTER' => 'S',
            'SHOW_IN_LIST' => 'Y',
            'EDIT_IN_LIST' => 'Y',
            'IS_SEARCHABLE' => 'Y',
            'SETTINGS' => [
                'SIZE' => 20,
                'ROWS' => 1,
                'REGEXP' => '',
                'MIN_LENGTH' => 0,
                'MAX_LENGTH' => 0,
                'DEFAULT_VALUE' => '',
            ],
            'EDIT_FORM_LABEL' => [
                'en' => 'Region',
                'ru' => 'Регион',
            ],
            'LIST_COLUMN_LABEL' => [
                'en' => 'Region',
                'ru' => 'Регион',
            ],
            'LIST_FILTER_LABEL' => [
                'en' => 'Region',
                'ru' => 'Регион',
            ],
            'ERROR_MESSAGE' => [
                'en' => '',
                'ru' => '',
            ],
            'HELP_MESSAGE' => [
                'en' => '',
                'ru' => '',
            ],
        ]);
        $helper->Hlblock()->saveField($hlblockId, [
            'FIELD_NAME' => 'UF_COUNTRY',
            'USER_TYPE_ID' => 'string',
            'XML_ID' => 'UF_COUNTRY',
            'SORT' => '400',
            'MULTIPLE' => 'N',
            'MANDATORY' => 'N',
            'SHOW_FILTER' => 'S',
            'SHOW_IN_LIST' => 'Y',
            'EDIT_IN_LIST' => 'Y',
            'IS_SEARCHABLE' => 'Y',
            'SETTINGS' => [
                'SIZE' => 20,
                'ROWS' => 1,
                'REGEXP' => '',
                'MIN_LENGTH' => 0,
                'MAX_LENGTH' => 0,
                'DEFAULT_VALUE' => '',
            ],
            'EDIT_FORM_LABEL' => [
                'en' => 'Country',
                'ru' => 'Страна',
            ],
            'LIST_COLUMN_LABEL' => [
                'en' => 'Country',
                'ru' => 'Страна',
            ],
            'LIST_FILTER_LABEL' => [
                'en' => 'Country',
                'ru' => 'Страна',
            ],
            'ERROR_MESSAGE' => [
                'en' => '',
                'ru' => '',
            ],
            'HELP_MESSAGE' => [
                'en' => '',
                'ru' => '',
            ],
        ]);
    }

    public function down(): void
    {
        $helper = $this->getHelperManager();
        $helper->Hlblock()->deleteHlblock(
            $helper->Hlblock()->getHlblockId(self::HL_BLOCK_NAME)
        );
    }
}
