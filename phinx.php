<?php

return
[
    'paths' => [
        'migrations' => '%%PHINX_CONFIG_DIR%%/Database/migrations',
//        'seeds' => '%%PHINX_CONFIG_DIR%%/db/seeds'
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_environment' => 'development',
        'production' => [
            'adapter' => 'mysql',
            'host' => 'mysql',
            'name' => 'phptests',
            'user' => 'root',
            'pass' => 'phptests',
            'port' => '3306',
            'charset' => 'utf8',
        ],
        'development' => [
            'adapter' => 'mysql',
            'host' => 'mysql',
            'name' => 'phptests',
            'user' => 'root',
            'pass' => 'phptests',
            'port' => '3306',
            'charset' => 'utf8',
        ],
        'testing' => [
            'adapter' => 'mysql',
            'host' => 'mysql',
            'name' => 'phptests',
            'user' => 'root',
            'pass' => 'phptests',
            'port' => '3306',
            'charset' => 'utf8',
        ]
    ],
    'version_order' => 'creation'
];
