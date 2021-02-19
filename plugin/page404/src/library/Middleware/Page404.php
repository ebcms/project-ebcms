<?php

declare(strict_types=1);

namespace App\Plugin\Page404\Middleware;

use Ebcms\App;
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
                Template $template
            ) use ($response) {
                $response->getBody()->write($template->renderFromFile('404@plugin/page404'));
            });
        }
        return $response;
    }
}
