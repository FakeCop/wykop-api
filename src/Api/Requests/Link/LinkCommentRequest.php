<?php

namespace FakeCop\WykopClient\Api\Requests\Link;

class LinkCommentRequest extends LinkBasedRequest
{
    protected int $linkId;

    protected int $commentId;

    public function __construct(int $linkId, int $commentId) {
        $this->linkId = $linkId;
        $this->commentId = $commentId;
    }

    public function resolveEndpoint(): string
    {
        return "{$this->urlLinkPrefix}/{$this->linkId}/comments/{$this->commentId}";
    }
}