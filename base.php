<?php

namespace dm;

defined('BASE_PATH') or define('BASE_PATH', __DIR__);

defined('DS') or define('DS', DIRECTORY_SEPARATOR);

class DiscountManager
{
    public static function autoload($className)
    {
        $filePath = str_replace(__NAMESPACE__, '', $className);
        $filePath = BASE_PATH . str_replace(['\\', '/'], DS, $filePath) . '.php';

        include($filePath);
    }
}

spl_autoload_register([__NAMESPACE__ . '\DiscountManager', 'autoload'], true, true);