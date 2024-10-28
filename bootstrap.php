<?php

use CORE\App;
use CORE\Container;
use CORE\Database;

$container = new Container();

$container->bind('CORE\Database', function () {
    $config = require BASEPATH('config.php');

    return new Database($config['database']);
});

$db=App::setContainer($container);
