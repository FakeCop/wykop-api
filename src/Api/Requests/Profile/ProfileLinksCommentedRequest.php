<?php

namespace FakeCop\WykopClient\Api\Requests\Profile;

class ProfileLinksCommentedRequest extends ProfileBasedRequest
{
    public function resolveEndpoint(): string
    {
        return "{$this->urlProfilePrefix}/{$this->username}/links/commented";
    }
}