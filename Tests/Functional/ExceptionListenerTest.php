<?php

namespace Samson\Bundle\UnexpectedResponseListener\Tests\Functional;

use Samson\Bundle\UnexpectedResponseBundle\Exception\UnexpectedResponseException;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class ExceptionListenerTest extends WebTestCase
{

    public function testResponseIsSetAsActualResponse()
    {
        $kernel = static::createKernel();
        $kernel->boot();

        $kernel->getContainer()->get('event_dispatcher')->removeSubscriber($kernel->getContainer()->get('security.firewall'));

        $request = new Request;
        $request->attributes->set('_controller', function() {
            $response = new Response('Exception response', 200, array('Content-type' => 'text/plain'));
            throw new UnexpectedResponseException($response);
        });
        $response = $kernel->handle($request);
        $this->assertEquals('Exception response', $response->getContent());
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringStartsWith('text/plain', $response->headers->get('content-type'));
    }
    
    public function testNormalExceptionIsNotProcessed()
    {
        $kernel = static::createKernel();
        $kernel->boot();

        $kernel->getContainer()->get('event_dispatcher')->removeSubscriber($kernel->getContainer()->get('security.firewall'));

        $request = new Request;
        $request->attributes->set('_controller', function() {
            $response = new Response('Exception response', 200, array('Content-type' => 'text/plain'));
            throw new \RuntimeException($response);
        });
        
        $response = $kernel->handle($request);
        $this->assertEquals(500, $response->getStatusCode());
    }

}
