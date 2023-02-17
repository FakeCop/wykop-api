<?php

namespace FakeCop\WykopClient\Traits;

trait ApiUrlPathTrait
{
    /**
     * @param string $username
     * @return string
     */
    public static function profilePath(string $username): string
    {
        return "profile/users/$username";
    }
}
