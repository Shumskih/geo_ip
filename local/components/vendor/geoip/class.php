<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

class geoip extends CBitrixComponent
{
    public function executeComponent(): void
    {
        $this->includeComponentTemplate();
    }
}
