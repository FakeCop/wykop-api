<?php

namespace FakeCop\WykopClient\Api\Requests\Link;

class LinkRedirectRequest extends LinkBasedRequest
{
    protected int $linkId;

    public function __construct(int $linkId) {
        $this->linkId = $linkId;
    }

    public function resolveEndpoint(): string
    {
        return "{$this->urlLinkPrefix}/{$this->linkId}/redirect";
    }
}