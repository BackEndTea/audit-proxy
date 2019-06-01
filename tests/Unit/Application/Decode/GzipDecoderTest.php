<?php

namespace Unit\Application\Decode;

use App\Application\Decode\GzipDecoder;
use PHPUnit\Framework\TestCase;

class GzipDecoderTest extends TestCase
{
    /**
     * @var GzipDecoder
     */
    private $decoder;

    public function setUp()
    {
        $this->decoder = new GzipDecoder();
    }

    /**
     * @test
     * @dataProvider requestData
     *
     * @param string $request
     */
    public function shouldDecodeIfGzipped(string $request)
    {
        $decoded = $this->decoder->decode($request);
        $json = json_decode($decoded, true);

        $this->assertArrayHasKey('requires', $json);
        $this->assertArrayHasKey('dependencies', $json);
        $this->assertArrayHasKey('install', $json);
        $this->assertArrayHasKey('remove', $json);
        $this->assertArrayHasKey('metadata', $json);
    }

    public function requestData()
    {
        return [
            'gzipped yarn request body' => [file_get_contents(__DIR__ . '/../../../fixtures/request-body-yarn.gz')],
            'gzipped npm request body' => [file_get_contents(__DIR__ . '/../../../fixtures/request-body-npm.gz')],
            'yarn request body' => [file_get_contents(__DIR__ . '/../../../fixtures/request-body-yarn.gz')],
            'npm request body'  => [file_get_contents(__DIR__ . '/../../../fixtures/request-body-npm.gz')],
        ];
    }
}
