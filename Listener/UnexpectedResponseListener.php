<?php

namespace Samson\Bundle\UnexpectedResponseBundle\Listener;

use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Samson\Bundle\UnexpectedResponseBundle\Exception\UnexpectedResponseException;

/**
 * @author Bart van den Burg <bart@samson-it.nl>
 */
class UnexpectedResponseListener
{

    /**
     * Listen for UnexpectedResponseExceptions in the kernel, catch them and set the response on it
     * @param GetResponseForExceptionEvent $event
     */
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $exception = $event->getException();

        if ($exception instanceof UnexpectedResponseException) {
            $event->setResponse($exception->getResponse());
        }
    }
}