<?php

namespace Vendor;

use Bitrix\Main\Mail\Event;
use Bitrix\Main\Entity\AddResult;

class Email
{
    public function send(string $text): AddResult
    {
        return Event::send([
            'EVENT_NAME' => 'GEO_IP_ERROR',
            'LID' => 's1',
            'C_FIELDS' => [
                'TEXT' => $text,
            ],
        ]);
    }
}
