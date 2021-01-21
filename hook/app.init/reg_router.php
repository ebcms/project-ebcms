<?php

use App\Ebcms\Cms\Http\Web\Category;
use App\Ebcms\Cms\Http\Web\Content;
use App\Ebcms\Cms\Http\Web\Index;
use App\Ebcms\Cms\Http\Web\Search;
use Ebcms\App;
use Ebcms\Router;
use Ebcms\Router\Collector;

App::getInstance()->execute(function (
    Router $router
) {
    $router->getCollector()->addGroup((function (): string {
        if (
            (!empty($_SERVER['REQUEST_SCHEME']) && $_SERVER['REQUEST_SCHEME'] == 'https')
            || (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on')
            || (!empty($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443')
        ) {
            $schema = 'https';
        } else {
            $schema = 'http';
        }

        return $schema . '://' . $_SERVER['HTTP_HOST'] . (function (): string {
            $script_name = '/' . implode('/', array_filter(explode('/', $_SERVER['SCRIPT_NAME'])));
            $request_uri = parse_url('/' . implode('/', array_filter(explode('/', $_SERVER['REQUEST_URI']))), PHP_URL_PATH);
            if (strpos($request_uri, $script_name) === 0) {
                return $script_name;
            } else {
                return strlen(dirname($script_name)) > 1 ? dirname($script_name) : '';
            }
        })();
    })(), function (Collector $collector) {
        $collector->get('/', Index::class, '/ebcms/cms/web/index');
        $collector->get('/category', Category::class, '/ebcms/cms/web/category');
        $collector->get('/content', Content::class, '/ebcms/cms/web/content');
        $collector->get('/search', Search::class, '/ebcms/cms/web/search');
    });
});
