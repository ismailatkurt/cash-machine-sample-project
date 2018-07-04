<?php

namespace CashMachine\Note\Domain\Models;

use CashMachine\Note\Domain\Contracts\WithdrawResultInterface;

class WithdrawResult implements WithdrawResultInterface
{
    /**
     * @var array NoteResult
     */
    private $notes = [];

    /**
     * @inheritdoc
     */
    public function setResult(array $notes)
    {
        $this->notes = $notes;
    }

    /**
     * @inheritdoc
     */
    public function getResult(): array
    {
        return $this->notes;
    }
}
