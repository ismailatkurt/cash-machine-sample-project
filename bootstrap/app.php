<?php

$application = new \Slim\App([
    'settings' => [
        'displayErrorDetails' => true
    ]
]);

require_once 'paths.php';
require_once 'dependencies.php';
require_once 'routes.php';

return $application;
