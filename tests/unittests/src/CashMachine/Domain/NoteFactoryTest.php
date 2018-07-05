<?php

namespace CashMachine\Tests\Note\Domain;

use CashMachine\Note\Domain\Models\Note;
use CashMachine\Note\Domain\NoteFactory;
use PHPUnit\Framework\TestCase;

class NoteFactoryTest extends TestCase
{
    /**
     * @test
     */
    public function create_test()
    {
        // prepare
        $value = 123;
        $expectedResult = new Note($value);

        $classUnderTest = new NoteFactory();

        // test
        $result = $classUnderTest->create($value);

        // verify
        $this->assertEquals($expectedResult, $result);
    }
}
