<?php

/** @var CMain $APPLICATION */

require($_SERVER["DOCUMENT_ROOT"] . '/bitrix/header.php');
$APPLICATION->SetTitle('GeoIP поиск');

$APPLICATION->IncludeComponent('vendor:geoip', '');

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");
