<?php

use Ebcms\App;
use Ebcms\Template;

App::getInstance()->execute(function (
    Template $template
) {
    $template->addPath('ebcms/cms', __DIR__ . '/../../template', 50);
});
