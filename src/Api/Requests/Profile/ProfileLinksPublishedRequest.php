<?php

namespace FakeCop\WykopClient\Api\Requests\Profile;

class ProfileLinksPublishedRequest extends ProfileBasedRequest
{
    public function resolveEndpoint(): string
    {
        return "{$this->urlProfilePrefix}/{$this->username}/links/published";
    }
}