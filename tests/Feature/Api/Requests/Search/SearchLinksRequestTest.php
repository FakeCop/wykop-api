<?php

namespace FakeCop\WykopClient\Tests\Feature\Api\Requests\Search;

use Carbon\Carbon;
use FakeCop\WykopClient\Facades\WykopClient;
use FakeCop\WykopClient\Tests\TestCase;

class SearchLinksRequestTest extends TestCase
{
    public function testRequest()
    {
        $response = WykopClient::getSearchLinks(
            queryParam: '', dateFrom: Carbon::now()->subMonth(), dateTo: Carbon::now(), domains: ['facebook.com']
        );

        $this->assertArrayHasKey('data', $response);
    }
}