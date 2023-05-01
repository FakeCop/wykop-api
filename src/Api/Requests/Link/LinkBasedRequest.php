<?php

namespace FakeCop\WykopClient\Api\Requests\Link;

use FakeCop\WykopClient\Api\Requests\ClientBasedRequest;
use Saloon\Enums\Method;

abstract class LinkBasedRequest extends ClientBasedRequest
{
    protected Method $method = Method::GET;

    protected string $urlLinkPrefix = '/links';
}