<?php

namespace FakeCop\WykopClient\Casts;

use FakeCop\WykopClient\DataTransferObjects\LinkType;
use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Support\DataProperty;

class LinkTypeCast implements Cast
{
    /**
     * @param \Spatie\LaravelData\Support\DataProperty $property
     * @param mixed $value
     * @param array $context
     * @return \FakeCop\WykopClient\DataTransferObjects\LinkType
     */
    public function cast(DataProperty $property, mixed $value, array $context): LinkType
    {
        return match (strtolower($value)) {
            'homepage' => LinkType::homepage(),
            'upcoming' => LinkType::upcoming(),
            default => LinkType::none()
        };
    }
}