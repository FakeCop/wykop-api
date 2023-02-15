<?php

namespace FakeCop\WykopClient\DataTransferObjects;

use Spatie\LaravelData\Data;

class Color extends Data
{
    /**
     * @param string $name
     * @param string $hex
     * @param string $hex_dark
     */
    public function __construct(
        public string $name,
        public string $hex,
        public string $hex_dark,
    )
    {
    }
}