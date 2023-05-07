<?php

namespace FakeCop\WykopClient\Api\Requests\Search;

use FakeCop\WykopClient\Api\Requests\Contracts\SearchSort;
use FakeCop\WykopClient\Api\Requests\Contracts\SearchUsersSort;
use FakeCop\WykopClient\Api\Requests\Contracts\SearchVote;
use Illuminate\Support\Carbon;
use phpDocumentor\Reflection\Types\Integer;

class SearchUsersRequest extends SearchBasedRequest
{
    public function __construct(
        public string $query,
        public SearchUsersSort $usersSort = SearchUsersSort::SCORE,
        public array $users = [],
        public int $page = 1,
    ) {
        parent::__construct(
            query: $query,
            users: $users,
        );
    }

    public function resolveEndpoint(): string
    {
        return "{$this->urlSearchPrefix}/users";
    }

    protected function defaultQuery(): array
    {
        return [
            ...parent::defaultQuery(),
            'page' => $this->page,
            'sort' => $this->usersSort->value,
        ];
    }
}