<?php

namespace FakeCop\WykopClient\DataTransferObjects\Profile;

use Carbon\Carbon;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Data;

class Banned extends Data
{
    public function __construct(
        public string $reason,
        #[WithCast(DateTimeInterfaceCast::class)]
        public Carbon $expired,
    )
    {
    }
}