<?php

use Ebcms\App;
use Ebcms\Config;
use Ebcms\Container;
use Ebcms\Hook;
use Ebcms\RequestFilter;
use Ebcms\Router;
use Ebcms\Session;
use Ebcms\Template;
use Psr\SimpleCache\CacheInterface;

return [
    Template::class => function (): Template {
        return App::getInstance()->execute(function (
            CacheInterface $cache,
            Container $container,
            Hook $hook
        ) {
            $template = new Template($cache);

            if (!function_exists('tpl_cache')) {
                function tpl_cache(int $ttl, string $id, string $tpl, $param = []): string
                {
                    return App::getInstance()->execute(function (
                        CacheInterface $cache,
                        Template $template
                    ) use ($id, $ttl, $tpl, $param): string {
                        if (null == $res = $cache->get('tpl_extend_cache_' . $id)) {
                            $res = $template->renderFromString(base64_decode($tpl), $param, $id);
                            $cache->set('tpl_extend_cache_' . $id, $res, $ttl);
                        }
                        return $res;
                    });
                }
            }
            $template->extend('/\{cache\s*(.*)\s*\}([\s\S]*)\{\/cache\}/Ui', function ($matchs) {
                $params = array_filter(explode(',', trim($matchs[1])));
                if (!isset($params[0])) {
                    $params[0] = 3600;
                }
                if (!isset($params[1])) {
                    $params[1] = '\'' . md5($matchs[2]) . '\'';
                }
                return '<?php echo tpl_cache(' . implode(',', $params) . ',\'' . base64_encode($matchs[2]) . '\'' . ', get_defined_vars());?>';
            });

            $template->assign([
                'app' => App::getInstance(),
                'container' => $container,
                'input' => $container->get(RequestFilter::class),
                'config' => $container->get(Config::class),
                'router' => $container->get(Router::class),
                'hook' => $container->get(Hook::class),
                'session' => $container->get(Session::class),
            ]);

            foreach (App::getInstance()->getPackages() as $key => $value) {
                $template->addPath($key, $value['dir'] . '/src/template');
                $template->addPath($key, App::getInstance()->getAppPath() . '/template/' . $key, 99);
            }

            $hook->emit('template.instance', $template);
            return $template;
        });
    }
];
