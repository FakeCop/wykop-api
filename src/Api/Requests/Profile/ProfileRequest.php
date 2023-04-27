<?php

namespace FakeCop\WykopClient\Api\Requests\Profile;

class ProfileRequest extends ProfileBasedRequest
{
    public function resolveEndpoint(): string
    {
        return "{$this->urlProfilePrefix}/{$this->username}";
    }
}