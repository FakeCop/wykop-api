<?php

namespace FakeCop\WykopClient\Api\Requests\Profile;

class ProfileEntriesAddedRequest extends ProfileBasedRequest
{
    public function resolveEndpoint(): string
    {
        return "{$this->urlProfilePrefix}/{$this->username}/entries/added";
    }
}