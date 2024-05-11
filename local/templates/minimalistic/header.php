<?php

/**
 * @var CMain $APPLICATION
 */

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
} ?>
<!doctype html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"
    >
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php $APPLICATION->ShowTitle(false); ?></title>
    <?php $APPLICATION->ShowHead(); ?>
</head>
<body class="d-flex flex-column min-vh-100 text-bg-dark">
    <main class="main">
        <header class="p-3 text-bg-dark d-flex justify-content-center py-3">
            <?php
            $APPLICATION->IncludeComponent(
                'bitrix:menu',
                'top',
                [
                    'ROOT_MENU_TYPE' => 'top',
                    'MAX_LEVEL' => '1',
                    'CHILD_MENU_TYPE' => 'left',
                    'USE_EXT' => 'N',
                    'MENU_CACHE_TYPE' => 'A',
                    'MENU_CACHE_TIME' => '36000000',
                    'MENU_CACHE_USE_GROUPS' => 'N',
                    'MENU_CACHE_GET_VARS' => '',
                ],
                false,
                [
                    'ACTIVE_COMPONENT' => 'Y',
                ]
            );
            ?>
        </header>
        <div class="container">
