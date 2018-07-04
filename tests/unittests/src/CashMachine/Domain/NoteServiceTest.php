<?php

namespace CashMachine\Tests\CashMachine\Domain;

use CashMachine\Note\Domain\NoteService;
use PHPUnit\Framework\TestCase;

class NoteServiceTest extends TestCase
{
    /**
     * @test
     */
    public function sampleMethod_test()
    {
        // prepare
        $classUnderTest = new NoteService();

        // test
        $result = $classUnderTest->sampleMethod();

        // verify
        $this->assertEquals(123, $result);
    }
}
