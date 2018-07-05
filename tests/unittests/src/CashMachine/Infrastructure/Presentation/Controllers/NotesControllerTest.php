<?php

namespace CashMachine\Tests\Note\Infrastructure\Presentation\Controllers;

use CashMachine\Note\Application\Services\NoteService;
use CashMachine\Note\Infrastructure\Presentation\Controllers\NotesController;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\InputFilter\InputFilter;

class NotesControllerTest extends TestCase
{
    /**
     * @test
     */
    public function construct_test()
    {
        // prepare
        /** @var ServerRequestInterface|\PHPUnit_Framework_MockObject_MockObject $requestMock */
        $requestMock = $this->createMock(ServerRequestInterface::class);

        /** @var ResponseInterface|\PHPUnit_Framework_MockObject_MockObject $responseMock */
        $responseMock = $this->createMock(ResponseInterface::class);

        /** @var InputFilter|\PHPUnit_Framework_MockObject_MockObject $inputFilterMock */
        $inputFilterMock = $this->createMock(InputFilter::class);

        /** @var NoteService|\PHPUnit_Framework_MockObject_MockObject $noteServiceMock */
        $noteServiceMock = $this->createMock(NoteService::class);

        // test
        $classUnderTest = new NotesController($requestMock, $responseMock, $inputFilterMock, $noteServiceMock);

        // verify
        $this->assertInstanceOf(NotesController::class, $classUnderTest);
    }
}
