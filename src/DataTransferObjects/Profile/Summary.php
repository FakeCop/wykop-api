<?php

namespace FakeCop\WykopClient\DataTransferObjects\Profile;

use Spatie\LaravelData\Data;

class Summary extends Data
{
    public function __construct(
        public int $actions,
        public int $links,
        public int $entries,
        public int $following_users,
        public int $following_tags,
        public int $followers,
    )
    {
    }
}