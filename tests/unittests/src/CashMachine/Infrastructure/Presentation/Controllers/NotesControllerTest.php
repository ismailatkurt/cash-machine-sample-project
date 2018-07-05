<?php

namespace CashMachine\Tests\Note\Infrastructure\Presentation\Controllers;

use CashMachine\Note\Application\Services\NoteService;
use CashMachine\Note\Domain\Exceptions\NoteUnavailableException;
use CashMachine\Note\Infrastructure\Presentation\Controllers\NotesController;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\StreamInterface;
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

    /**
     * @test
     */
    public function withdraw_test()
    {
        // prepare
        $amount = 1234;
        $someTestValue = 'someTestValue';
        $expectedResult['result'] = $someTestValue;

        /** @var ServerRequestInterface|\PHPUnit_Framework_MockObject_MockObject $requestMock */
        $requestMock = $this->createMock(ServerRequestInterface::class);

        /** @var InputFilter|\PHPUnit_Framework_MockObject_MockObject $inputFilterMock */
        $inputFilterMock = $this->createMock(InputFilter::class);
        $inputFilterMock->expects($this->once())
            ->method('isValid')
            ->willReturn(true);
        $inputFilterMock->expects($this->once())
            ->method('getValue')
            ->with('amount')
            ->willReturn($amount);

        /** @var NoteService|\PHPUnit_Framework_MockObject_MockObject $noteServiceMock */
        $noteServiceMock = $this->createMock(NoteService::class);
        $noteServiceMock->expects($this->once())
            ->method('withDraw')
            ->with($amount)
            ->willReturn($someTestValue);


        /** @var ResponseInterface|\PHPUnit_Framework_MockObject_MockObject $responseMock */
        $responseMock = $this->createMock(ResponseInterface::class);
        $responseMock->expects($this->once())
            ->method('withStatus')
            ->with(200)
            ->willReturn($responseMock);
        $responseMock->expects($this->once())
            ->method('withHeader')
            ->with('Content-type', 'application/json')
            ->willReturn($responseMock);

        /** @var StreamInterface|\PHPUnit_Framework_MockObject_MockObject $responseBodyMock */
        $responseBodyMock = $this->createMock(StreamInterface::class);
        $responseBodyMock->expects($this->once())
            ->method('write')
            ->with(json_encode($expectedResult));
        $responseMock->expects($this->once())
            ->method('getBody')
            ->willReturn($responseBodyMock);



        $classUnderTest = new NotesController($requestMock, $responseMock, $inputFilterMock, $noteServiceMock);

        // test
        $result = $classUnderTest->withdraw($amount);

        // verify
        $this->assertEquals($responseMock, $result);
    }

    /**
     * @test
     */
    public function withdrawThrowsException_test()
    {
        // prepare
        $amount = 1234;
        $expectedResult['result'] = 'NoteUnavailable';

        /** @var ServerRequestInterface|\PHPUnit_Framework_MockObject_MockObject $requestMock */
        $requestMock = $this->createMock(ServerRequestInterface::class);

        /** @var InputFilter|\PHPUnit_Framework_MockObject_MockObject $inputFilterMock */
        $inputFilterMock = $this->createMock(InputFilter::class);
        $inputFilterMock->expects($this->once())
            ->method('isValid')
            ->willReturn(true);
        $inputFilterMock->expects($this->once())
            ->method('getValue')
            ->with('amount')
            ->willReturn($amount);

        /** @var NoteService|\PHPUnit_Framework_MockObject_MockObject $noteServiceMock */
        $noteServiceMock = $this->createMock(NoteService::class);
        $noteServiceMock->expects($this->once())
            ->method('withDraw')
            ->with($amount)
            ->willThrowException(new NoteUnavailableException());

        /** @var ResponseInterface|\PHPUnit_Framework_MockObject_MockObject $responseMock */
        $responseMock = $this->createMock(ResponseInterface::class);
        $responseMock->expects($this->once())
            ->method('withStatus')
            ->with(200)
            ->willReturn($responseMock);
        $responseMock->expects($this->once())
            ->method('withHeader')
            ->with('Content-type', 'application/json')
            ->willReturn($responseMock);

        /** @var StreamInterface|\PHPUnit_Framework_MockObject_MockObject $responseBodyMock */
        $responseBodyMock = $this->createMock(StreamInterface::class);
        $responseBodyMock->expects($this->once())
            ->method('write')
            ->with(json_encode($expectedResult));
        $responseMock->expects($this->once())
            ->method('getBody')
            ->willReturn($responseBodyMock);

        $classUnderTest = new NotesController($requestMock, $responseMock, $inputFilterMock, $noteServiceMock);

        // test
        $result = $classUnderTest->withdraw($amount);

        // verify
        $this->assertEquals($responseMock, $result);
    }

    /**
     * @test
     */
    public function withdrawValidationFails_test()
    {
        // prepare
        $amount = 1234;
        $expectedResult['result'] = 'some input filter message here';

        /** @var ServerRequestInterface|\PHPUnit_Framework_MockObject_MockObject $requestMock */
        $requestMock = $this->createMock(ServerRequestInterface::class);

        /** @var InputFilter|\PHPUnit_Framework_MockObject_MockObject $inputFilterMock */
        $inputFilterMock = $this->createMock(InputFilter::class);
        $inputFilterMock->expects($this->once())
            ->method('isValid')
            ->willReturn(false);
        $inputFilterMock->expects($this->once())
            ->method('getMessages')
            ->willReturn('some input filter message here');

        /** @var NoteService|\PHPUnit_Framework_MockObject_MockObject $noteServiceMock */
        $noteServiceMock = $this->createMock(NoteService::class);

        /** @var ResponseInterface|\PHPUnit_Framework_MockObject_MockObject $responseMock */
        $responseMock = $this->createMock(ResponseInterface::class);
        $responseMock->expects($this->once())
            ->method('withStatus')
            ->with(200)
            ->willReturn($responseMock);
        $responseMock->expects($this->once())
            ->method('withHeader')
            ->with('Content-type', 'application/json')
            ->willReturn($responseMock);

        /** @var StreamInterface|\PHPUnit_Framework_MockObject_MockObject $responseBodyMock */
        $responseBodyMock = $this->createMock(StreamInterface::class);
        $responseBodyMock->expects($this->once())
            ->method('write')
            ->with(json_encode($expectedResult));
        $responseMock->expects($this->once())
            ->method('getBody')
            ->willReturn($responseBodyMock);

        $classUnderTest = new NotesController($requestMock, $responseMock, $inputFilterMock, $noteServiceMock);

        // test
        $result = $classUnderTest->withdraw($amount);

        // verify
        $this->assertEquals($responseMock, $result);
    }
}
