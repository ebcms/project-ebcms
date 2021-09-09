<?php

declare(strict_types=1);

namespace App\Plugin\Page404\Middleware;

use Ebcms\App;
use Ebcms\ResponseFactory;
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
            return App::getInstance()->execute(function (
                ResponseFactory $responseFactory,
                Template $template
            ) {
                return $responseFactory->createGeneralResponse(404, [], $template->renderFromFile('404@plugin/page404'));
            });
        }
        return $response;
    }
}
