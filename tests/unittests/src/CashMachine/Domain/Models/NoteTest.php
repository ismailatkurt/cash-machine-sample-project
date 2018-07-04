<?php

namespace CashMachine\Tests\Note\Domain\Models;

use CashMachine\Note\Domain\Models\Note;
use PHPUnit\Framework\TestCase;

class NoteServiceTest extends TestCase
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
}
