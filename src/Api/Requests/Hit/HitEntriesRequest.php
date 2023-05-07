<?php

namespace FakeCop\WykopClient\Api\Requests\Hit;

class HitEntriesRequest extends HitBasedRequest
{
    public function resolveEndpoint(): string
    {
        return "{$this->urlHitPrefix}/entries";
    }
}