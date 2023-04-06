<?php

namespace FakeCop\WykopClient\Tests\Unit\Api;

use FakeCop\WykopClient\Api\Client;
use FakeCop\WykopClient\Tests\TestCase;

class ClientTest extends TestCase
{
    public function testClientConstructor()
    {
        self::assertInstanceOf(Client::class, new Client());
    }
}