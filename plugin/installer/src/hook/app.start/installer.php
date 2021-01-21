<?php

use App\Plugin\Installer\Middleware\JumpInstaller;
use Ebcms\App;
use Ebcms\RequestHandler;

App::getInstance()->execute(function (
    RequestHandler $requestHandler,
    App $app
) {
    $lock_file = $app->getAppPath() . '/config/install.lock';
    if (!file_exists($lock_file)) {
        $requestHandler->lazyMiddleware(JumpInstaller::class);
    } else {
        $plugin_lock_file = $app->getAppPath() . '/config/plugin/installer/install.lock';
        if (file_exists($plugin_lock_file)) {
            @unlink($plugin_lock_file);
        }
    }
});
