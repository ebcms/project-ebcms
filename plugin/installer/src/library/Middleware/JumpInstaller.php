<?php

declare(strict_types=1);

namespace App\Plugin\Installer\Middleware;

use Ebcms\App;
use Ebcms\Router;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class JumpInstaller implements MiddlewareInterface
{
    public function process(
        ServerRequestInterface $request,
        RequestHandlerInterface $handler
    ): ResponseInterface {
        return App::getInstance()->execute(function (
            App $app,
            Router $router,
            ResponseFactoryInterface $responseFactory
        ) use ($request, $handler): ResponseInterface {
            $lock_file = $app->getAppPath() . '/config/install.lock';
            if (!file_exists($lock_file)) {
                if (!$app->getRequestClass() || strpos($app->getRequestClass(), '\\App\\Plugin\\Installer\\Http\\Index') !== 0) {
                    $response = $responseFactory->createResponse(302);
                    return $response->withHeader('Location', $router->buildUrl('/plugin/installer/index'));
                }
            }
            return $handler->handle($request);
        });
    }
}
