<?php

use CashMachine\Bootstrap\DiKeys;
use Symfony\Component\Yaml\Yaml;

$container = $application->getContainer();

$container[DiKeys::APPLICATION_CONFIG] = function () use ($container) {
    $result = defined('APPLICATION_ENV') ?
        APPLICATION_ENV :
        (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production');

    switch ($result) {
        case 'production':
            $file = 'production';
            break;
        case 'staging':
            $file = 'staging';
            break;
        default:
            $file = 'production';
            break;
    }

    $contents = file_get_contents(CONFIG_PATH . $file . '.yaml');

    return Yaml::parse($contents);
};

$container[DiKeys::NOTES_CONTROLLER] = function (\Psr\Container\ContainerInterface $container) {
    return new \CashMachine\Note\Infrastructure\Presentation\Controllers\NotesController(
        $container->get(DiKeys::REQUEST),
        $container->get(DiKeys::RESPONSE),
        $container->get(DiKeys::WITHDRAW_AMOUNT_REQUEST_FILTER),
        $container->get(DiKeys::NOTE_APPLICATION_SERVICE)
    );
};

$container[DiKeys::WITHDRAW_AMOUNT_REQUEST_FILTER] = function () {
    return new \CashMachine\Note\Application\RequestFilters\WithdrawAmountFilter();
};

$container[DiKeys::NOTE_APPLICATION_SERVICE] = function (\Psr\Container\ContainerInterface $container) {
    return new \CashMachine\Note\Application\Services\NoteService(
        $container->get(DiKeys::NOTE_DOMAIN_SERVICE)
    );
};

$container[DiKeys::NOTE_DOMAIN_SERVICE] = function (\Psr\Container\ContainerInterface $container) {
    return new \CashMachine\Note\Domain\NoteService(
        $container->get(DiKeys::NOTE_REPOSITORY)
    );
};

$container[DiKeys::NOTE_REPOSITORY] = function (\Psr\Container\ContainerInterface $container) {
    $noteConfig = $container->get(DiKeys::APPLICATION_CONFIG)['availableNotes'];

    return new \CashMachine\Note\Infrastructure\Persistence\Repositories\NoteRepository(
        new \CashMachine\Note\Domain\NoteFactory(),
        $noteConfig
    );
};