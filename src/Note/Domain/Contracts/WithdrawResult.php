<?php

namespace CashMachine\Note\Domain\Contracts;

interface WithdrawResultInterface
{
    /**
     * @param array $notes
     */
    public function setResult(array $notes);

    /**
     * @return array
     */
    public function getResult(): array;
}
