<?php

namespace FakeCop\WykopClient\Api\Requests\Search;

use FakeCop\WykopClient\Api\Requests\Contracts\SearchSort;
use FakeCop\WykopClient\Api\Requests\Contracts\SearchVote;
use Carbon\Carbon;

class SearchLinksRequest extends SearchBasedRequest
{
    /**
     * @param string $queryParam
     * @param ?Carbon $dateFrom
     * @param ?Carbon $dateTo
     * @param \FakeCop\WykopClient\Api\Requests\Contracts\SearchSort $sort
     * @param \FakeCop\WykopClient\Api\Requests\Contracts\SearchVote $votes
     * @param array $domains
     * @param array $users
     * @param array $tags
     * @param string|null $category
     * @param string|null $bucket
     * @param int $page
     * @param int $limit
     */
    public function __construct(
        public string $queryParam,
        public ?Carbon $dateFrom,
        public ?Carbon $dateTo,
        public SearchSort $sort = SearchSort::SCORE,
        public SearchVote $votes = SearchVote::HUNDRED,
        public array $domains = [],
        public array $users = [],
        public array $tags = [],
        public ?string $category = null,
        public ?string $bucket = null,
        public int $page = 1,
        public int $limit = 25,
    ) {
        parent::__construct($this->queryParam, $dateFrom, $dateTo, $sort, $votes, $domains, $users, $tags, $category, $bucket);
    }

    public function resolveEndpoint(): string
    {
        return "{$this->urlSearchPrefix}/links";
    }

    protected function defaultQuery(): array
    {
        return [
            ...parent::defaultQuery(),
            'page' => $this->page,
            'limit' => $this->limit,
        ];
    }
}