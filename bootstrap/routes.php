<?php

use CashMachine\Bootstrap\DiKeys;

$application->get('/notes/withdraw/[{amount}]', function ($request, $response, $args) use ($container) {
    /** @var \CashMachine\Note\Infrastructure\Presentation\Controllers\NotesController $notesController */
    $notesController = $container->get(DiKeys::NOTES_CONTROLLER);

    return $notesController->withdraw($args);
});