<?php

namespace CashMachine\Note\Domain\Models;

use CashMachine\Note\Domain\Contracts\NoteInterface;

class Note implements NoteInterface
{
    /**
     * @var int
     */
    private $value;

    /**
     * @param int $value
     */
    public function __construct(int $value)
    {
        $this->value = $value;
    }

    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }

    /**
     * @return int
     */
    public function jsonSerialize()
    {
        return $this->value;
    }
}
