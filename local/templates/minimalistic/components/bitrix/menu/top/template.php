<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

$this->setFrameMode(true);

if (empty($arResult)) {
    return;
} ?>
<ul class="nav">
    <?php
    foreach ($arResult as $itemIndex => $item):
        ?>
        <li>
            <a
                    <?= empty($item['SELECTED']) ? 'href="' . $item['LINK'] . '"' : '' ?>
                    class="nav-link px-2<?= !empty($item['SELECTED']) ? ' link-secondary' : ' link-body-emphasis' ?>"
            >
                <?= $item['TEXT'] ?>
            </a>
        </li>
    <?php
    endforeach;
    ?>
</ul>
