<?php

namespace Unit\Application\Decode;

use App\Application\Dto\UncachedResponse;
use App\Application\Factory\RequestHashFactory;
use App\Domain\ValueObject\RequestHash;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;

class RequestHashFactoryTest extends TestCase
{
    /**
     * @var RequestHashFactory
     */
    private $factory;

    public function setUp()
    {
        $this->factory = new RequestHashFactory();
    }

    /**
     * @test
     */
    public function shouldCreateRequestHash()
    {
        $requestBody = 'request-string';
        $requestHash = $this->factory->createFromRequest($requestBody);

        $this->assertInstanceOf(RequestHash::class, $requestHash);
        $this->assertEquals(md5($requestBody), (string) $requestHash);
    }
}
