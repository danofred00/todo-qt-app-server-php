<?php

    /**
     *  Default config for app 
    */
    use Dotenv\Dotenv;

    // load .env file 
    $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
    $dotenv->load();

    define("DATABASE_NAME", $_ENV["DATABASE_NAME"]);

    define("DATABASE_HOST", $_ENV["DATABASE_HOST"]);

    define("DATABASE_USERNAME", $_ENV["DATABASE_USERNAME"]);

    define("DATABASE_PASSWORD", $_ENV["DATABASE_PASSWORD"]);

    define("DATABASE_TABLE_USERS", $_ENV["DATABASE_TABLE_USERS"]);

    define("DATABASE_TABLE_TASKS", $_ENV["DATABASE_TABLE_TASKS"]);

    define("DATABASE_TABLE_CATEGORY", $_ENV["DATABASE_TABLE_CATEGORY"]);

    define("DEFAULT_TARGET_URL", "/");