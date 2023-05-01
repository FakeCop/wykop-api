<?php

namespace FakeCop\WykopClient\Api\Requests\Link;

use FakeCop\WykopClient\Api\Requests\Contracts\ActionType;

class LinkUpVotesRequest extends LinkBasedRequest
{
    protected int $linkId;

    protected ActionType $type;

    public function __construct(int $linkId, ActionType $type) {
        $this->linkId = $linkId;
        $this->type = $type;
    }

    public function resolveEndpoint(): string
    {
        return "{$this->urlLinkPrefix}/{$this->linkId}/upvotes/{$this->type}";
    }
}