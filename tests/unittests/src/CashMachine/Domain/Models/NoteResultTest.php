<?php

namespace CashMachine\Tests\Note\Domain\Models;

use CashMachine\Note\Domain\Contracts\NoteResultInterface;
use CashMachine\Note\Domain\Models\NoteResult;
use PHPUnit\Framework\TestCase;

class NoteResultTest extends TestCase
{
    /**
     * @test
     */
    public function constructTest_test()
    {
        // prepare
        $value = 12;
        $amount = 34;

        // test
        $classUnderTest = new NoteResult($value, $amount);

        // verify
        $this->assertInstanceOf(NoteResult::class, $classUnderTest);
    }

    /**
     * @test
     */
    public function getters_test()
    {
        // prepare
        $expectedValue = 12;
        $expectedAmount = 34;

        // test
        $classUnderTest = new NoteResult($expectedValue, $expectedAmount);

        $value = $classUnderTest->getValue();
        $amount = $classUnderTest->getAmount();

        // verify
        $this->assertEquals($expectedValue, $value);
        $this->assertEquals($expectedAmount, $amount);
    }

    /**
     * @test
     */
    public function jsonSerialize_test()
    {
        $expectedValue = 12;
        $expectedAmount = 34;

        $expectedResult = '{"12":34}';

        // test
        $classUnderTest = new NoteResult($expectedValue, $expectedAmount);

        $result = json_encode($classUnderTest);

        // verify
        $this->assertEquals($expectedResult, $result);
    }
}
