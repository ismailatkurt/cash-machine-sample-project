<?php

namespace CashMachine\Note\Application\RequestFilters;

use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\InputFilter\Input;
use Zend\InputFilter\InputFilter;
use Zend\Validator\Digits;
use Zend\Validator\NotEmpty;

class WithdrawAmountFilter extends InputFilter
{
    public function __construct()
    {
        $this->init();
    }

    public function init()
    {
        parent::init();

        $amountInput = new Input('amount');
        $amountInput->getFilterChain()->attach(new StringTrim());
        $amountInput->getFilterChain()->attach(new StripTags());
        $amountInput->getValidatorChain()->attach(new NotEmpty());
        $amountInput->getValidatorChain()->attach(new Digits());
        $amountInput->setRequired(true);
        $this->add($amountInput);
    }
}
