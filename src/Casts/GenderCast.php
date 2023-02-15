<?php

namespace FakeCop\WykopClient\Casts;

use FakeCop\WykopClient\DataTransferObjects\Gender;
use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Support\DataProperty;

class GenderCast implements Cast
{
    /**
     * @param \Spatie\LaravelData\Support\DataProperty $property
     * @param mixed $value
     * @param array $context
     * @return \FakeCop\WykopClient\DataTransferObjects\Gender
     */
    public function cast(DataProperty $property, mixed $value, array $context): Gender
    {
        return match (strtolower($value))
        {
            'm' => Gender::male(),
            'f' => Gender::female(),
            default => Gender::unknown()
        };
    }
}