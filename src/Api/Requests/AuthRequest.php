<?php

namespace FakeCop\WykopClient\Api\Requests;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\SoloRequest;
use Saloon\Traits\Body\HasJsonBody;

class AuthRequest extends SoloRequest implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return config('wykop-client.api_url') . '/auth';
    }
}