<?php

namespace FakeCop\WykopClient\Api\Requests\Profile;

class ProfileLinksDownRequest extends ProfileBasedRequest
{
    public function resolveEndpoint(): string
    {
        return "{$this->urlProfilePrefix}/{$this->username}/links/down";
    }
}