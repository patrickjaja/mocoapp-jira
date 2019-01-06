<?php

define('APPLICATION_ROOT_DIR', __DIR__);
define('APPLICATION_VENDOR_DIR', APPLICATION_ROOT_DIR . '/vendor');
define('APPLICATION_SOURCE_DIR', APPLICATION_ROOT_DIR . '/src');
define('APPLICATION', '');
define('APPLICATION_ENV', '');
define('APPLICATION_STORE', '');

require_once(__DIR__ . '/src/Generated/Client/Ide/AutoCompletion.php');
require_once(__DIR__ . '/src/Generated/Service/Ide/AutoCompletion.php');
require_once(__DIR__ . '/src/Generated/Yves/Ide/AutoCompletion.php');
require_once(__DIR__ . '/src/Generated/Zed/Ide/AutoCompletion.php');

$codeceptionShimFilePath = __DIR__ . '/vendor/codeception/codeception/shim.php';
if (file_exists($codeceptionShimFilePath)) {
    require_once($codeceptionShimFilePath);
}

// Shim to not throw "Function opcache_invalidate not found" error when opcache is not enabled
if (!function_exists('opcache_invalidate')) {
    /**
     * @param string $script
     * @param bool $force
     *
     * @return void
     */
    function opcache_invalidate($script, $force = false)
    {
    }
}
