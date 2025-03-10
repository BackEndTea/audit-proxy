<?php

namespace App\Tests\Functional;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Uri;
use PHPUnit\Framework\TestCase;

class YarnProxyAuditRequestTest extends TestCase
{
    /**
     * @var Client
     */
    private $client;

    public function setUp()
    {
        $this->client = new Client();
    }

    public function testWithGzippedBody(): void
    {
        $request = new Request(
            'POST',
            new Uri('http://audit-proxy.test/-/npm/v1/security/audits'),
            json_decode(file_get_contents(__DIR__ . '/../fixtures/headers-yarn.json'), true),
            fopen(__DIR__ . '/../fixtures/request-body-yarn.gz', 'r')
        );
        $response = $this->client->send($request);

        $this->assertEquals(200, $response->getStatusCode(), 'Expected response to return a 200');
        $this->assertJson($response->getBody()->getContents(), 'Expected response to be valid Json');
    }
}
