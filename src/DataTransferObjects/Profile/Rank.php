<?php

namespace FakeCop\WykopClient\DataTransferObjects\Profile;

use Spatie\LaravelData\Data;

class Rank extends Data
{
    public function __construct(
        public int $position,
        public int $trend
    )
    {
    }
}