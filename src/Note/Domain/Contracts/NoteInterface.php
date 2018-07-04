<?php

namespace CashMachine\Note\Domain\Contracts;

interface NoteInterface extends \JsonSerializable
{
    /**
     * @param int $value
     */
    public function __construct(int $value);
}
