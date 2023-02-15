<?php

namespace FakeCop\WykopClient\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static array getProfileUser(string $username)
 * @method static array getProfileUserShort(string $username)
 * @method static array getProfileUserActions(string $username, int $page)
 * @method static array getProfileUserEntriesVoted(string $username, int $page)
 * @method static array getProfileUserLinksAdded(string $username, int $page)
 * @method static array getProfileUserLinksPublished(string $username, int $page)
 * @method static array getProfileUserLinksUp(string $username, int $page)
 * @method static array getProfileUserLinksDown(string $username, int $page)
 * @method static array getProfileUserLinksCommented(string $username, int $page)
 * @method static array getProfileUserObservedUsersFollowing(string $username, int $page)
 * @method static array getProfileUserObservedUsersFollowers(string $username, int $page)
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
