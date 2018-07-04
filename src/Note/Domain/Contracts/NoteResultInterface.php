<?php

namespace CashMachine\Note\Domain\Contracts;

use JsonSerializable;

interface NoteResultInterface extends JsonSerializable
{
    /**
     * @param int $value
     * @param int $amount
     */
    public function __construct(int $value, int $amount);
}
