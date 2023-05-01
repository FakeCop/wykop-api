<?php

namespace FakeCop\WykopClient\Facades;

use FakeCop\WykopClient\Api\Requests\Contracts\ActionType;
use FakeCop\WykopClient\Api\Requests\Contracts\LinkType;
use FakeCop\WykopClient\Api\Requests\Contracts\Sort;
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
 * @method static array getLinkList(int $page = 1, int $limit = 25, ?Sort $sort = null, ?LinkType $type = null, ?string $category = null, ?string $bucket = null)
 * @method static array getLinkUrl(string $url)
 * @method static array getLink(int $linkId)
 * @method static array getLinkUpVotes(int $linkId, ActionType $type)
 * @method static array getLinkRedirect(int $linkId)
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
