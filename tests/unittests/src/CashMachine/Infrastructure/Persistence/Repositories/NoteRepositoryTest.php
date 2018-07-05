<?php

namespace CashMachine\Tests\Note\Infrastructure\Persistence\Repositories;

use CashMachine\Note\Domain\Models\Note;
use CashMachine\Note\Domain\NoteFactory;
use CashMachine\Note\Infrastructure\Persistence\Repositories\NoteRepository;
use PHPUnit\Framework\TestCase;

class NoteRepositoryTest extends TestCase
{
    /**
     * @test
     */
    public function construct_test()
    {
        // prepare
        /** @var NoteFactory|\PHPUnit_Framework_MockObject_MockObject $noteFactoryMock */
        $noteFactoryMock = $this->createMock(NoteFactory::class);

        $noteConfigMock = [
            100 => 100,
            50 => 50,
            20 => 20,
            10 => 10
        ];

        // test
        $classUnderTest = new NoteRepository($noteFactoryMock, $noteConfigMock);

        // verify
        $this->assertInstanceOf(NoteRepository::class, $classUnderTest);
    }

    /**
     * @test
     */
    public function constructInjection_test()
    {
        // prepare
        /** @var NoteFactory|\PHPUnit_Framework_MockObject_MockObject $givenNoteFactoryMock */
        $givenNoteFactoryMock = $this->createMock(NoteFactory::class);

        $givenNoteConfigMock = [
            100 => 100,
            50 => 50,
            20 => 20,
            10 => 10
        ];

        $classUnderTest = new NoteRepository($givenNoteFactoryMock, $givenNoteConfigMock);

        // test
        $noteConfig = $classUnderTest->getNoteConfig();
        $noteFactory = $classUnderTest->getNoteFactory();

        // verify
        $this->assertEquals($givenNoteConfigMock, $noteConfig);
        $this->assertEquals($givenNoteFactoryMock, $noteFactory);
    }

    /**
     * @test
     */
    public function getAll_test()
    {
        // prepare
        /** @var NoteFactory $givenNoteFactory */
        $givenNoteFactory = new NoteFactory();

        $givenNoteConfigMock = [
            100 => 100,
            50 => 50,
            20 => 20,
            10 => 10
        ];

        $expectedResult = [
            new Note(100),
            new Note(50),
            new Note(20),
            new Note(10)
        ];

        $classUnderTest = new NoteRepository($givenNoteFactory, $givenNoteConfigMock);

        // test
        $result = $classUnderTest->getAll();

        // verify
        $this->assertEquals($expectedResult, $result);
    }
}
