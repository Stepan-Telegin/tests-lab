<?php

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;

class ApiTest extends TestCase
{
   public function testRequest(): void
   {
       $client = new Client([
           'base_uri' => 'http://nginx',
           'http_errors' => false
       ]);

       $response = $client->get('/index.php');

       $this->assertEquals(200, $response->getStatusCode());
   }
}