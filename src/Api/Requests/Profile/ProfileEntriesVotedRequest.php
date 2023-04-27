<?php

namespace FakeCop\WykopClient\Api\Requests\Profile;

class ProfileEntriesVotedRequest extends ProfileBasedRequest
{
    public function resolveEndpoint(): string
    {
        return "{$this->urlProfilePrefix}/{$this->username}/entries/voted";
    }
}