<?php

namespace CashMachine\Tests\Note\Domain;

use CashMachine\Note\Domain\Contracts\NoteRepositoryInterface;
use CashMachine\Note\Domain\Models\Note;
use CashMachine\Note\Domain\Models\NoteResult;
use CashMachine\Note\Domain\NoteService;
use PHPUnit\Framework\TestCase;

class NoteServiceTest extends TestCase
{
    /**
     * @test
     */
    public function construct_test()
    {
        // prepare
        /** @var NoteRepositoryInterface $noteRepositoryMock */
        $noteRepositoryMock = $this->createMock(NoteRepositoryInterface::class);

        // test
        $classUnderTest = new NoteService($noteRepositoryMock);

        // verify
        $this->assertInstanceOf(NoteService::class, $classUnderTest);
    }

    /**
     * @test
     */
    public function constructInjection_test()
    {
        // prepare
        /** @var NoteRepositoryInterface $noteRepositoryMock */
        $noteRepositoryMock = $this->createMock(NoteRepositoryInterface::class);

        $classUnderTest = new NoteService($noteRepositoryMock);

        // test
        $noteRepository = $classUnderTest->getNoteRepository();

        // verify
        $this->assertEquals($noteRepositoryMock, $noteRepository);
    }

    /**
     * @dataProvider getSuccessfulSampleDataSet
     * @description This test asserts the main business logic.
     * @test
     */
    public function withdrawSuccessful_test($amount, $expectedResult)
    {
        // prepare
        $availableNotes = [
            0 => new Note(100),
            1 => new Note(50),
            2 => new Note(20),
            3 => new Note(10)
        ];

        /** @var NoteRepositoryInterface|\PHPUnit_Framework_MockObject_MockObject $noteRepositoryMock */
        $noteRepositoryMock = $this->createMock(NoteRepositoryInterface::class);
        $noteRepositoryMock->expects($this->once())
            ->method('getAll')
            ->willReturn($availableNotes);

        $classUnderTest = new NoteService($noteRepositoryMock);

        // test
        $result = $classUnderTest->withdraw($amount);

        // verify
        $this->assertEquals($expectedResult, $result);
    }

    /**
     * @test
     * @expectedException \CashMachine\Note\Domain\Exceptions\NoteUnavailableException
     */
    public function withdrawThrowsException_test()
    {
        // prepare
        $amount = 135;
        $availableNotes = [
            0 => new Note(100),
            1 => new Note(50),
            2 => new Note(20),
            3 => new Note(10)
        ];

        /** @var NoteRepositoryInterface|\PHPUnit_Framework_MockObject_MockObject $noteRepositoryMock */
        $noteRepositoryMock = $this->createMock(NoteRepositoryInterface::class);
        $noteRepositoryMock->expects($this->once())
            ->method('getAll')
            ->willReturn($availableNotes);

        $classUnderTest = new NoteService($noteRepositoryMock);

        // test
        $result = $classUnderTest->withdraw($amount);

        // verify
    }

    public function getSuccessfulSampleDataSet()
    {
        return [
            'sample1' => [
                '130', [
                    new NoteResult(100, 1),
                    new NoteResult(50, 0),
                    new NoteResult(20, 1),
                    new NoteResult(10, 1)
                ]
            ],
            'sample2' => [
                '200', [
                    new NoteResult(100, 2),
                    new NoteResult(50, 0),
                    new NoteResult(20, 0),
                    new NoteResult(10, 0)
                ]
            ],
            'sample3' => [
                '180', [
                    new NoteResult(100, 1),
                    new NoteResult(50, 1),
                    new NoteResult(20, 1),
                    new NoteResult(10, 1)
                ]
            ],
            'sample4' => [
                '190', [
                    new NoteResult(100, 1),
                    new NoteResult(50, 1),
                    new NoteResult(20, 2),
                    new NoteResult(10, 0)
                ]
            ]
        ];
    }
}
