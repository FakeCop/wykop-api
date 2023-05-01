<?php

namespace FakeCop\WykopClient\Api\Requests\Link;

class LinkCommentCommentsRequest extends LinkBasedRequest
{
    protected int $linkId;

    protected int $commentId;

    protected int $page = 1;

    public function __construct(int $linkId, int $commentId, int $page = 1) {
        $this->linkId = $linkId;
        $this->commentId = $commentId;
        $this->page = 1;
    }

    public function resolveEndpoint(): string
    {
        return "{$this->urlLinkPrefix}/{$this->linkId}/comments/{$this->commentId}/comments";
    }

    protected function defaultQuery(): array
    {
        return [
            'page' => $this->page,
        ];
    }
}