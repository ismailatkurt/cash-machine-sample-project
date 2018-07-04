<?php

namespace CashMachine\Note\Domain;

use CashMachine\Note\Domain\Models\Note;

class NoteFactory
{
    /**
     * @param int $value
     * @return Note
     */
    public function create(int $value)
    {
        return new Note($value);
    }
}
