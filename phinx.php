<?php

require "public/index.php";

$migrations = $seeds = [];

foreach ($modules as $module){
    if(!is_null($module::MIGRATIONS)){
        $migrations[] = $module::MIGRATIONS;
    }
}

foreach ($modules as $module){
    if(!is_null($module::SEEDS)){
        $seeds[] = $module::SEEDS;
    }
}

return [
    "paths" => [
            "migrations" => $migrations,
            "seeds" => $seeds,
    ],
    "environments" => [
        "default_migration_table" => "geekdoos_migrations",
        "default_database" => "development",
        "development" => [
            "adapter" => $app->getContainer()->get("database")['adapter'],
            "host" => $app->getContainer()->get("database")['host'],
            "name" => $app->getContainer()->get("database")['name'],
            "user" => $app->getContainer()->get("database")['user'],
            "pass" => $app->getContainer()->get("database")['pass'],
            "port" => $app->getContainer()->get("database")['port'],
            "charset" => $app->getContainer()->get("database")['charset'],
        ]
    ]
];
/*
paths:
    migrations: '%%PHINX_CONFIG_DIR%%/db/migrations'
    seeds: '%%PHINX_CONFIG_DIR%%/db/seeds'

environments:
    default_migration_table: phinxlog
    default_database: development
    production:
        adapter: mysql
        host: localhost
        name: production_db
        user: root
        pass: ''
        port: 3306
        charset: utf8

    development:
        adapter: mysql
        host: localhost
        name: development_db
        user: root
        pass: ''
        port: 3306
        charset: utf8

    testing:
        adapter: mysql
        host: localhost
        name: testing_db
        user: root
        pass: ''
        port: 3306
        charset: utf8

version_order: creation
*/