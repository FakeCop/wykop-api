<?php

namespace FakeCop\WykopClient\Api\Requests\Search;

class SearchAllRequest extends SearchBasedRequest
{
    public function resolveEndpoint(): string
    {
        return "{$this->urlSearchPrefix}/all";
    }
}