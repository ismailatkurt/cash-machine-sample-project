<?php

namespace CashMachine\Note\Application\Services;

use CashMachine\Note\Domain\Models\NoteResult;
use CashMachine\Note\Domain\NoteService as NoteDomainService;

class NoteService
{
    /**
     * @var NoteDomainService
     */
    private $service;

    /**
     * @param NoteDomainService $service
     */
    public function __construct(NoteDomainService $service)
    {
        $this->service = $service;
    }

    /**
     * @param int $amount
     * @return array|\CashMachine\Note\Domain\Contracts\WithdrawResultInterface
     */
    public function withDraw(int $amount)
    {
        $result = $this->service->withdraw($amount);
        $result = $this->filterResult($result);

        return $result;
    }

    /**
     * @param array $result
     * @return array|mixed
     */
    public function filterResult(array $result)
    {
        $result = array_filter($result, function (NoteResult $v, $k) {
            return $v->getAmount() !== 0;
        }, ARRAY_FILTER_USE_BOTH);

        return $result;
    }
}