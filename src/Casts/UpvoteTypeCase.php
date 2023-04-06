<?php

namespace FakeCop\WykopClient\Casts;

use FakeCop\WykopClient\DataTransferObjects\UpvoteType;
use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Support\DataProperty;

class UpvoteTypeCase implements Cast
{
    /**
     * @param \Spatie\LaravelData\Support\DataProperty $property
     * @param mixed $value
     * @param array $context
     * @return \FakeCop\WykopClient\DataTransferObjects\UpvoteType
     */
    public function cast(DataProperty $property, mixed $value, array $context): UpvoteType
    {
        return match (strtolower($value)) {
            'down' => UpvoteType::down(),
            default => UpvoteType::up()
        };
    }
}