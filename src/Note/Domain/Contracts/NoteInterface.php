<?php

namespace CashMachine\Note\Domain\Contracts;

use CashMachine\Common\Domain\Contracts\ModelInterface;

interface NoteInterface extends ModelInterface
{
    /**
     * @param int $value
     */
    public function __construct(int $value);
}
