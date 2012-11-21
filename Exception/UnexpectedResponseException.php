<?php

namespace Samson\Bundle\UnexpectedResponseBundle\Exception;

use RuntimeException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

/**
 * Exception class holding a Response object to be sent to the client
 * 
 * @author Bart van den Burg <bart@samson-it.nl>
 */
class UnexpectedResponseException extends RuntimeException implements HttpExceptionInterface
{
    private $response;

    /**
     * @param Response $response The response to be sent to the browser
     */
    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    /**
     * @return Response
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @return array An array of all the response headers
     */
    public function getHeaders()
    {
        return $this->response->headers->all();
    }

    /**
     * @return int the response status code
     */
    public function getStatusCode()
    {
        return $this->response->getStatusCode();
    }
}
