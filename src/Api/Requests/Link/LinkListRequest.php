<?php

namespace FakeCop\WykopClient\Api\Requests\Link;

use FakeCop\WykopClient\Api\Requests\Contracts\LinkType;
use FakeCop\WykopClient\Api\Requests\Contracts\Sort;

class LinkListRequest extends LinkBasedRequest
{
    protected int $page = 1;

    protected int $limit = 25;

    protected ?Sort $sort;

    protected ?LinkType $type;

    protected ?string $category;

    protected ?string $bucket;

    public function __construct(
        int $page = 1,
        int $limit = 25,
        ?Sort $sort = null,
        ?LinkType $type = null,
        ?string $category = null,
        ?string $bucket = null
    ) {
        $this->page = $page;
        $this->limit = $limit;
        $this->sort = $sort;
        $this->type = $type;
        $this->category = $category;
        $this->bucket = $bucket;
    }

    public function resolveEndpoint(): string
    {
        return $this->urlLinkPrefix;
    }

    protected function defaultQuery(): array
    {
        return [
            'page' => $this->page,
            'limit' => $this->limit,
            'sort' => $this->sort,
            'type' => $this->type,
            'category' => $this->category,
            'bucket' => $this->bucket,
        ];
    }
}