<?php

namespace FakeCop\WykopClient\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static array getProfile(string $username)
 * @method static array getProfileShort(string $username)
 * @method static array getProfileActions(string $username)
 * @method static array getProfileEntriesAdded(string $username)
 * @method static array getProfileEntriesVoted(string $username)
 * @method static array getProfileEntriesCommented(string $username)
 * @method static array getProfileLinksAdded(string $username)
 * @method static array getProfileLinksPublished(string $username)
 * @method static array getProfileLinksUp(string $username)
 * @method static array getProfileLinksDown(string $username)
 * @method static array getProfileLinksCommented(string $username)
 */
class WykopClient extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'wykop_client';
    }
}
