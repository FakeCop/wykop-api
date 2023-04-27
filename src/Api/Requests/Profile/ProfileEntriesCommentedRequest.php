<?php

namespace FakeCop\WykopClient\Api\Requests\Profile;

class ProfileEntriesCommentedRequest extends ProfileBasedRequest
{
    public function resolveEndpoint(): string
    {
        return "{$this->urlProfilePrefix}/{$this->username}/entries/commented";
    }
}