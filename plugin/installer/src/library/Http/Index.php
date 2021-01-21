<?php

declare(strict_types=1);

namespace App\Plugin\Installer\Http;

use Ebcms\App;
use PDO;
use Rah\Danpu\Dump;
use Rah\Danpu\Import;
use Ebcms\RequestFilter;
use Ebcms\Template;

class Index extends Common
{

    public function get(
        RequestFilter $input,
        Template $template
    ) {
        $tpl = 'step' . $input->get('step', 0, ['intval']) . '@plugin/installer';
        return $this->html($template->renderFromFile($tpl));
    }

    public function post(
        Template $template,
        Dump $dump,
        App $app,
        RequestFilter $input
    ) {
        try {
            $dump
                ->file($app->getAppPath() . '/install.sql')
                ->dsn('mysql:dbname=' . $input->post('database_name') . ';host=' . $input->post('database_server'))
                ->user($input->post('database_username'))
                ->pass($input->post('database_password'))
                ->attributes([
                    PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true,
                ])
                ->tmp($app->getAppPath() . '/runtime');
            new Import($dump);

            $databasetpl = <<<'str'
<?php
return [
    'master'=>[
        'database_type' => 'mysql',
        'database_name' => '{database_name}',
        'server' => '{server}',
        'username' => '{username}',
        'password' => '{password}',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_general_ci',
        'port' => '{port}',
        'logging' => false,
        'option' => [
            \PDO::ATTR_CASE => \PDO::CASE_NATURAL,
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_STRINGIFY_FETCHES => false,
            \PDO::ATTR_EMULATE_PREPARES => false,
        ],
        'command' => ['SET SQL_MODE=ANSI_QUOTES'],
    ],
];
str;

            $database_file = $app->getAppPath() . '/config/database.php';
            if (!file_exists($database_file)) {
                if (!is_dir(dirname($database_file))) {
                    mkdir(dirname($database_file), 0755, true);
                }
            }
            file_put_contents($database_file, str_replace([
                '{server}',
                '{port}',
                '{database_name}',
                '{username}',
                '{password}',
            ], [
                $input->post('database_server'),
                $input->post('database_port'),
                $input->post('database_name'),
                $input->post('database_username'),
                $input->post('database_password'),
            ], $databasetpl));
            file_put_contents($app->getAppPath() . '/config/install.lock', date('Y-m-d H:i:s'));
        } catch (\Throwable $th) {
            return $this->failure('发生错误：' . $th->getMessage());
        }

        return $this->html($template->renderFromFile('success@plugin/installer', [
            'account' => 'admin',
            'password' => '123456',
        ]));
    }
}
