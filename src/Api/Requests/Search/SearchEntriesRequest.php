<?php

namespace FakeCop\WykopClient\Api\Requests\Search;

use FakeCop\WykopClient\Api\Requests\Contracts\SearchSort;
use FakeCop\WykopClient\Api\Requests\Contracts\SearchVote;
use Illuminate\Support\Carbon;
use phpDocumentor\Reflection\Types\Integer;

class SearchEntriesRequest extends SearchBasedRequest
{
    public function __construct(
        public string $query,
        public Carbon $dateFrom,
        public Carbon $dateTo,
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
        parent::__construct($query, $dateFrom, $dateTo, $sort, $votes, $domains, $users, $tags, $category, $bucket,);
    }

    public function resolveEndpoint(): string
    {
        return "{$this->urlSearchPrefix}/entries";
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