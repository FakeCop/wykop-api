<?php

namespace FakeCop\WykopClient\Api\Requests\Hit;

use FakeCop\WykopClient\Api\Requests\ClientBasedRequest;
use FakeCop\WykopClient\Api\Requests\Contracts\HitSort;
use Saloon\Enums\Method;

abstract class HitBasedRequest extends ClientBasedRequest
{
    protected Method $method = Method::GET;

    protected string $urlHitPrefix = '/hits';

    public function __construct(
        public int $year,
        public int $month,
        public HitSort $sort = HitSort::ALL
    ) {}

    protected function defaultQuery(): array
    {
        return [
            'year' => $this->year,
            'month' => $this->month,
            'sort' => $this->sort->value
        ];
    }
}