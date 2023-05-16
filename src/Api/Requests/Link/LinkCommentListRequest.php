<?php

namespace FakeCop\WykopClient\Api\Requests\Link;

use FakeCop\WykopClient\Api\Requests\Contracts\CommentSort;

class LinkCommentListRequest extends LinkBasedRequest
{
    protected int $linkId;

    protected int $page = 1;

    protected int $limit = 25;

    protected ?CommentSort $sort;

    protected bool $ama;

    public function __construct(
        int $linkId,
        int $page = 1,
        int $limit = 25,
        ?CommentSort $sort = null,
        bool $ama = false,
    ) {
        $this->linkId = $linkId;
        $this->page = $page;
        $this->limit = $limit;
        $this->sort = $sort;
        $this->ama = $ama;
    }

    public function resolveEndpoint(): string
    {
        return "{$this->urlLinkPrefix}/{$this->linkId}/comments";
    }

    protected function defaultQuery(): array
    {
        return [
            'page' => $this->page,
            'limit' => $this->limit,
            'sort' => $this->sort->value ?? null,
            'ama' => $this->ama
        ];
    }
}