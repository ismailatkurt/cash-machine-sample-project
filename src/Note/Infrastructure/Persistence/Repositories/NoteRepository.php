<?php

namespace CashMachine\Note\Infrastructure\Persistence\Repositories;

use CashMachine\Note\Domain\Contracts\NoteRepositoryInterface;
use CashMachine\Note\Domain\Models\Note;
use CashMachine\Note\Domain\NoteFactory;

class NoteRepository implements NoteRepositoryInterface
{
    /**
     * @var array
     */
    private $noteConfig;

    /**
     * @var NoteFactory
     */
    private $noteFactory;

    /**
     * @param NoteFactory $noteFactory
     * @param array $noteConfig
     */
    public function __construct(NoteFactory $noteFactory, array $noteConfig)
    {
        $this->noteConfig = $noteConfig;
        $this->noteFactory = $noteFactory;
    }

    /**
     * @return Note[]
     */
    public function getAll(): array
    {
        /** @var Note[] $notes */
        $notes = [];

        foreach ($this->noteConfig as $key => $value) {
            $notes[] = $this->noteFactory->create($value);
        }

        return $notes;
    }
}