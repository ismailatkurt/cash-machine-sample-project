<?php

namespace CashMachine\Note\Domain\Models;

use CashMachine\Note\Domain\Contracts\NoteResultInterface;

class NoteResult implements NoteResultInterface
{
    /**
     * @var int
     */
    private $value;

    /**
     * @var int
     */
    private $amount;

    /**
     * @param int $value
     * @param int $amount
     */
    public function __construct(int $value, int $amount)
    {
        $this->value = $value;
        $this->amount = $amount;
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
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            $this->value => $this->amount
        ];
    }
}
