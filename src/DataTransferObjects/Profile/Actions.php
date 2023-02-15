<?php

namespace FakeCop\WykopClient\DataTransferObjects\Profile;

use Spatie\LaravelData\Data;

class Actions extends Data
{
    public function __construct(
        public bool $update,
        public bool $update_gender,
        public bool $update_note,
        public bool $blacklist,
        public bool $follow
    )
    {
    }
}