<?php

declare(strict_types=1);

namespace App\Plugin\Installer\Http;

use App\Ebcms\Admin\Traits\ResponseTrait;
use App\Ebcms\Admin\Traits\RestfulTrait;
use App\Plugin\Installer\Middleware\Lock;
use Composer\Autoload\ClassLoader;
use Ebcms\RequestHandler;

abstract class Common
{
    use RestfulTrait;
    use ResponseTrait;

    public function __construct(
        RequestHandler $requestHandler
    ) {
        $loader = new ClassLoader;
        $loader->addPsr4('Rah\\Danpu\\', __DIR__ . '/../../../danpu-master/src/Rah/Danpu/');
        $loader->register();
        $requestHandler->lazyMiddleware(Lock::class);
    }
}
