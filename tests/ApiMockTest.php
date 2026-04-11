<?php

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Client;

class ApiMockTest extends TestCase
{
    public function testMockRequest(): void
    {
        $mock = new MockHandler([
            new Response(200, [], 'OK')
        ]);

        $handlerStack = HandlerStack::create($mock);
        $client = new Client(['handler' => $handlerStack]);

        $response = $client->get('/test');

        $this->assertEquals(200, $response->getStatusCode());
    }
}