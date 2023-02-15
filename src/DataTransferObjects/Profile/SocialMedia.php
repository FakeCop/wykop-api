<?php

namespace FakeCop\WykopClient\DataTransferObjects\Profile;

use Spatie\LaravelData\Data;

class SocialMedia extends Data
{
    public function __construct(
        public string $facebook,
        public string $instagram,
        public string $twitter,
    )
    {
    }
}