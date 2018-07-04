<?php

namespace CashMachine\Note\Domain;

use CashMachine\Note\Domain\Contracts\NoteRepositoryInterface;
use CashMachine\Note\Domain\Exceptions\NoteUnavailableException;
use CashMachine\Note\Domain\Models\NoteResult;

class NoteService
{
    /**
     * @var NoteRepositoryInterface
     */
    private $noteRepository;

    /**
     * @var array
     */
    private $result = [
        '100' => 0,
        '50' => 0,
        '20' => 0,
        '10' => 0
    ];

    /**
     * @param NoteRepositoryInterface $noteRepository
     */
    public function __construct(NoteRepositoryInterface $noteRepository)
    {
        $this->noteRepository = $noteRepository;
    }

    public function withdraw(int $amount)
    {
        $availableNotes = json_decode(json_encode($this->noteRepository->getAll()), true);

        $result = $this->giveMeBiggestPossible($amount, $availableNotes);

        if ($result !== 0) {
            throw new NoteUnavailableException();
        } else {
            $result = $this->mapResult();
        }

        return $result;
    }

    private function giveMeBiggestPossible(int $amount, array $dividers)
    {
        while ($amount / $dividers[0] >= 1) {
            $amount -= $dividers[0];
            $this->result[$dividers[0]] += 1;
        }

        if (sizeof($dividers) > 1) {
            $amount = $this->giveMeBiggestPossible($amount, array_slice($dividers, 1));
        }

        return $amount;
    }

    /**
     * @return array
     */
    private function mapResult()
    {
        $withdrawResults = [];

        foreach ($this->result as $value => $amount) {
            $withdrawResults[] = new NoteResult($value, $amount);
        }

        return $withdrawResults;
    }

}
