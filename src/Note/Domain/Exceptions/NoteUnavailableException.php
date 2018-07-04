<?php

namespace CashMachine\Note\Domain\Exceptions;

class NoteUnavailableException extends \Exception
{
    protected $message = 'NoteUnavailable';
}
