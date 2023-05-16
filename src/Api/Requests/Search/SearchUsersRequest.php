<?php

namespace FakeCop\WykopClient\Api\Requests\Search;

use FakeCop\WykopClient\Api\Requests\Contracts\SearchUsersSort;

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