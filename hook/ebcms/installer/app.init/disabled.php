<?php

use Ebcms\App;

if (!is_file(App::getInstance()->getAppPath() . '/config/install.lock')) {
    define('EBCMS_CMS_WEB_ROUTER', 1);
}
