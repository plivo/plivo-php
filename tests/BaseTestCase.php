<?php

namespace Plivo\Tests;



use PHPUnit\Framework\TestCase;
use PHPUnit\Runner\Version;
use Plivo\Authentication\BasicAuth;
use Plivo\RestClient;
use Plivo\BaseClient;
use Plivo\MessageClient;

/**
 * Class BaseTestCase
 * @package Plivo\Tests
 */
class BaseTestCase extends TestCase
{
    /**
     * @var RestClient
     */
    protected $client;
    /**
     * @var TestClient
     */
    protected $testClient = null;

    /**
     *
     */
    protected function setUp(): void
    {
        $this->client = new RestClient("MAXXXXXXXXXXXXXXXXXX", "AbcdEfghIjklMnop1234");
        $this->testClient = new TestClient(null,
            new BasicAuth("MAXXXXXXXXXXXXXXXXXX", "AbcdEfghIjklMnop1234"));
        $this->client->msgClient->setHttpClientHandler($this->testClient);
        $this->client->client->setHttpClientHandler($this->testClient);
    }

    /**
     * @param $request
     */
    public function assertRequest($request) {
        $this->testClient->assertRequest($request);
        self::assertTrue(true);
    }

    /**
     * @param $response
     */
    public function mock($response)
    {
        $this->testClient->mock($response);
    }

    /**
     * @param $response
     */
    public function expectPlivoException($exception)
    {
        if (version_compare(Version::id(), '7.0.0', '<')) {
            self::setExpectedException($exception);
        } else {
            self::expectException($exception);
        }

    }
}
