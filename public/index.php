<?php

define('PROJECT_PATH', dirname(__DIR__));

require_once PROJECT_PATH . '/vendor/autoload.php';

require_once PROJECT_PATH . '/bootstrap/paths.php';

$application = require_once PROJECT_PATH . '/bootstrap/app.php';

$application->run();
