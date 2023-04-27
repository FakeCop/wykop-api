<?php

namespace FakeCop\WykopClient\Api\Requests\Profile;

class ProfileActionsRequest extends ProfileBasedRequest
{
    public function resolveEndpoint(): string
    {
        return "{$this->urlProfilePrefix}/{$this->username}/actions";
    }
}