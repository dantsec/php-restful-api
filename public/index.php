<?php

require_once __DIR__ . '/../vendor/autoloader.php';
require_once __DIR__ . '/../routes/web.php';

use RestfulAPI\Utils\Env;
use RestfulAPI\Core\Core;

Env::load();
Core::run($router);
