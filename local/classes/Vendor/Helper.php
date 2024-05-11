<?php

namespace Vendor;

class Helper
{
    private const CLEAN_FLAGS = ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML5;

    public function cleanData(string $data)
    {
        return filter_var(htmlspecialchars(trim($data), self::CLEAN_FLAGS), FILTER_SANITIZE_ADD_SLASHES);
    }
}
