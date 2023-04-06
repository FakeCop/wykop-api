<?php

namespace FakeCop\WykopClient\Casts;

use FakeCop\WykopClient\DataTransferObjects\LinkSort;
use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Support\DataProperty;

class LinkSortCast implements Cast
{
    /**
     * @param \Spatie\LaravelData\Support\DataProperty $property
     * @param mixed $value
     * @param array $context
     * @return \FakeCop\WykopClient\DataTransferObjects\LinkSort
     */
    public function cast(DataProperty $property, mixed $value, array $context): LinkSort
    {
        return match (strtolower($value)) {
            'newest' => LinkSort::newest(),
            'active' => LinkSort::active(),
            'commented' => LinkSort::commented(),
            'digged' => LinkSort::digged(),
            default => LinkSort::none()
        };
    }
}