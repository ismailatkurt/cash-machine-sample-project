<?php

namespace CashMachine\Tests\Note\Domain\Models;

use CashMachine\Note\Domain\Models\Note;
use PHPUnit\Framework\TestCase;

class NoteTest extends TestCase
{
    /**
     * @test
     */
    public function sampleMethod_test()
    {
        // prepare
        $value = 123;

        $classUnderTest = new Note($value);

        // test
        $result = $classUnderTest->getValue();

        // verify
        $this->assertEquals($value, $result);
    }

    /**
     * @test
     */
    public function jsonSerialize_test()
    {
        // prepare
        $value = 1234;

        $classUnderTest = new Note($value);

        // test
        $result = json_encode($classUnderTest);

        // verify
        $this->assertEquals($value, $result);
    }
}
