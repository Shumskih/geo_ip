<?php

use Bitrix\Main;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
} ?>
</div>
</main>
        <div class="container mt-auto">
            <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
                <div class="col-md-4 d-flex align-items-center">
                    <span class="mb-3 mb-md-0 text-body-secondary">© <?= (new Main\Type\Date())->format('Y') ?> GeoIp</span>
                </div>
            </footer>
        </div>
    </body>
</html>
