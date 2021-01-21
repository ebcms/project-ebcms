<?php

declare(strict_types=1);

namespace App\Plugin\Page404\Middleware;

use Ebcms\App;
use Ebcms\Config;
use Ebcms\Template;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class Page404 implements MiddlewareInterface
{
    public function process(
        ServerRequestInterface $request,
        RequestHandlerInterface $handler
    ): ResponseInterface {
        $response = $handler->handle($request);
        if ($response->getStatusCode() == 404) {
            App::getInstance()->execute(function (
                App $app,
                Config $config,
                Template $template
            ) use ($response) {
                if (isset($app->getPackages()['ebcms/fragment'])) {
                    $tpl = '{if function_exists(\'tpl_fragment\')}{fragment \'plugin.page404.tpl_404\', \'暂无\'}{/if}';
                } else {
                    $tpl = $config->get('fragments.tpl_404@plugin.page404', '页面不存在！');
                }
                $response->getBody()->write($template->renderFromString($tpl));
            });
        }
        return $response;
    }
}
