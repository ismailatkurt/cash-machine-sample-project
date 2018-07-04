<?php

namespace CashMachine\Note\Domain\Contracts;

use CashMachine\Note\Domain\Models\Note;

interface NoteRepositoryInterface
{
    /**
     * @return Note[]
     */
    public function getAll(): array;
}
