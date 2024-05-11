<?php

use Bitrix\Main\UI\Extension;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

/**
 * @var array $arResult
 */

$this->setFrameMode(true);
Extension::load('local.geoip'); ?>

<div id="application" class="d-flex justify-content-center"></div>

<script>
    let application = new BX.Application('#application');
    application.start();
</script>
