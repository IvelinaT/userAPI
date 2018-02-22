<?php
require_once 'bootstrap/app.php';
$database = $container['settings']['db'];
return [
    'paths' => [
        'migrations' => 'src/database/migrations',
        'seeds' => 'src/database/seeds'
    ],
    'environments' => [
        'default' => [
            'adapter' => $database['driver'],
            'host' => $database['host'],
            'port' => $database['port'],
            'name' => $database['database'],
            'user' => $database['username'],
            'pass' => $database['password']
        ],
        'default_migration_table' => 'migrations'
    ],
    'migration_base_class' => 'BaseMigration',

];