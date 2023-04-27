<?php

namespace FakeCop\WykopClient\Api\Requests\Profile;

use FakeCop\WykopClient\Api\Requests\ClientBasedRequest;
use Saloon\Enums\Method;

abstract class ProfileBasedRequest extends ClientBasedRequest
{
    protected Method $method = Method::GET;

    protected string $urlProfilePrefix = '/profile/users';

    public function __construct(
        protected string $username
    ) { }
}