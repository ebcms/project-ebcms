<?php

use App\Plugin\Page404\Middleware\Page404;
use Ebcms\App;
use Ebcms\RequestHandler;

App::getInstance()->execute(function (
    RequestHandler $requestHandler
) {
    $requestHandler->lazyMiddleware(Page404::class);
});
