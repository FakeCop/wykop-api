<?php

namespace FakeCop\WykopClient\Api\Requests\Hit;

class HitLinksRequest extends HitBasedRequest
{
    public function resolveEndpoint(): string
    {
        return "{$this->urlHitPrefix}/links";
    }
}