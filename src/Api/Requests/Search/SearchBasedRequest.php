<?php

namespace FakeCop\WykopClient\Api\Requests\Search;

use FakeCop\WykopClient\Api\Requests\ClientBasedRequest;
use FakeCop\WykopClient\Api\Requests\Contracts\SearchSort;
use FakeCop\WykopClient\Api\Requests\Contracts\SearchVote;
use Carbon\Carbon;
use Saloon\Enums\Method;

abstract class SearchBasedRequest extends ClientBasedRequest
{
    protected Method $method = Method::GET;

    protected string $urlSearchPrefix = '/search';

    public function __construct(
        public string $queryParam,
        public ?Carbon $dateFrom = null,
        public ?Carbon $dateTo = null,
        public SearchSort $sort = SearchSort::SCORE,
        public SearchVote $votes = SearchVote::HUNDRED,
        public array $domains = [],
        public array $users = [],
        public array $tags = [],
        public ?string $category = null,
        public ?string $bucket = null,
    ) { }

    protected function defaultQuery(): array
    {
        return [
            'query' => $this->queryParam,
            'sort' => $this->sort->value,
            'votes' => $this->votes->value,
            'date_from' => $this->dateFrom->format('Y-m-d H:i:s') ?? null,
            'date_to' => $this->dateTo->format('Y-m-d H:i:s') ?? null,
            'domains' => $this->domains,
            'users' => $this->users,
            'tags' => $this->tags,
            'category' => $this->category,
            'bucket' => $this->bucket,
        ];
    }
}