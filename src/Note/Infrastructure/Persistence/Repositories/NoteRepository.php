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

        foreach ($this->getNoteConfig() as $key => $value) {
            $notes[] = $this->getNoteFactory()->create($value);
        }

        return $notes;
    }

    /**
     * @return array
     */
    public function getNoteConfig(): array
    {
        return $this->noteConfig;
    }

    /**
     * @return NoteFactory
     */
    public function getNoteFactory(): NoteFactory
    {
        return $this->noteFactory;
    }
}