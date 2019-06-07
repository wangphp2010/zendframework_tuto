<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

 #https://docs.zendframework.com/tutorials/db-adapter/ 教程
return [
    'db' => [
        'driver' => 'Pdo',
        'dsn'    => sprintf('sqlite:%s/data/zftutorial.db', realpath(getcwd())),
        //'dsn'    => 'mysql:dbname=zftutorial;host=localhost;charset=utf8',

    ],
];
/*
return [
    'db' => [
        'adapters' => [
            'Application\Db\WriteAdapter' => [
                'driver' => 'Pdo',
                'dsn'    => 'mysql:dbname=application;host=canonical.example.com;charset=utf8',
            ],
            'Application\Db\ReadOnlyAdapter' => [
                'driver' => 'Pdo',
                'dsn'    => 'mysql:dbname=application;host=replica.example.com;charset=utf8',
            ],
        ],
    ],
];
*/