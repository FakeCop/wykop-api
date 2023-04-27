<?php

namespace FakeCop\WykopClient\Api\Requests\Profile;

class ProfileLinksUpRequest extends ProfileBasedRequest
{
    public function resolveEndpoint(): string
    {
        return "{$this->urlProfilePrefix}/{$this->username}/links/up";
    }
}