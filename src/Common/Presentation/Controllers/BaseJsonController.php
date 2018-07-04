<?php

namespace CashMachine\Common\Presentation\Controllers;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\InputFilter\InputFilter;

abstract class BaseJsonController
{
    /**
     * @var ServerRequestInterface
     */
    protected $request;

    /**
     * @var ResponseInterface
     */
    protected $response;

    /**
     * @var InputFilter
     */
    protected $inputFilter;

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param InputFilter $inputFilter
     */
    public function __construct(ServerRequestInterface $request, ResponseInterface $response, InputFilter $inputFilter)
    {
        $this->request = $request;
        $this->response = $response;
        $this->inputFilter = $inputFilter;
    }

    /**
     * @param int $statusCode
     * @param array $content
     * @return ResponseInterface
     */
    public function setJsonResponse(int $statusCode, array $content)
    {
        $response = $this->response->withStatus($statusCode);

        $response = $response->withHeader('Content-type', 'application/json');
        $response->getBody()->write(json_encode($content, true));

        return $response;
    }
}
