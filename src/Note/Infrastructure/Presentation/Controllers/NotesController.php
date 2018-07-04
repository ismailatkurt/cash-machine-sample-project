<?php

namespace CashMachine\Note\Infrastructure\Presentation\Controllers;

use CashMachine\Common\Presentation\Controllers\BaseJsonController;
use CashMachine\Note\Application\Services\NoteService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\InputFilter\InputFilter;

class NotesController extends BaseJsonController
{
    /**
     * @var NoteService
     */
    private $noteService;

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param InputFilter $inputFilter
     * @param NoteService $noteService
     */
    public function __construct(
        ServerRequestInterface $request,
        ResponseInterface $response,
        InputFilter $inputFilter,
        NoteService $noteService
    ) {
        parent::__construct($request, $response, $inputFilter);
        $this->noteService = $noteService;
    }

    /**
     * @param $amount
     * @return ResponseInterface
     */
    public function withdraw($amount): ResponseInterface
    {
        $this->inputFilter->setData($amount);

        if ($this->inputFilter->isValid()) {
            $amount = $this->inputFilter->getValue('amount');

            try {
                $content['result'] = $this->noteService->withDraw($amount);

            } catch (\Exception $exception) {
                $content['result'] = $exception->getMessage();
            }
        } else {
            $content['result'] = $this->inputFilter->getMessages();
        }

        return $this->setJsonResponse(200, $content);
    }
}
