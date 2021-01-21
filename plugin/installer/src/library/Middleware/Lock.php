<?php

declare(strict_types=1);

namespace App\Plugin\Installer\Middleware;

use Ebcms\App;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class Lock implements MiddlewareInterface
{
    public function process(
        ServerRequestInterface $request,
        RequestHandlerInterface $handler
    ): ResponseInterface {
        return App::getInstance()->execute(function (
            App $app,
            ResponseFactoryInterface $responseFactory
        ) use ($request, $handler): ResponseInterface {
            $lock_file = $app->getAppPath() . '/config/install.lock';
            if (file_exists($lock_file)) {
                $response = $responseFactory->createResponse(200);
                $response->getBody()->write('系统已安装，若需重新安装，请删除：' . $lock_file . ' 文件！');
                return $response;
            }
            return $handler->handle($request);
        });
    }
}
