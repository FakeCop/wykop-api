<?php

namespace FakeCop\WykopClient\Facades;

use FakeCop\WykopClient\Api\Requests\Contracts\ActionType;
use FakeCop\WykopClient\Api\Requests\Contracts\CommentSort;
use FakeCop\WykopClient\Api\Requests\Contracts\HitSort;
use FakeCop\WykopClient\Api\Requests\Contracts\LinkType;
use FakeCop\WykopClient\Api\Requests\Contracts\LinkSort;
use FakeCop\WykopClient\Api\Requests\Contracts\SearchSort;
use FakeCop\WykopClient\Api\Requests\Contracts\SearchUsersSort;
use FakeCop\WykopClient\Api\Requests\Contracts\SearchVote;
use Carbon\Carbon;
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
 * @method static array getLinkList(int $page = 1, int $limit = 25, ?LinkSort $sort = null, ?LinkType $type = null, ?string $category = null, ?string $bucket = null)
 * @method static array getLinkUrl(string $url)
 * @method static array getLink(int $linkId)
 * @method static array getLinkUpVotes(int $linkId, ActionType $type)
 * @method static array getLinkRedirect(int $linkId)
 * @method static array getLinkRelated(int $linkId)
 * @method static array getLinkCommentList(int $linkId, int $page = 1, int $limit = 25, ?CommentSort $sort = null, bool $ama = false)
 * @method static array getLinkComment(int $linkId, int $commentId)
 * @method static array getLinkCommentComments(int $linkId, int $commentId, int $page = 1)
 * @method static array getHitLinks(int $year, int $month, HitSort $sort = HitSort::ALL)
 * @method static array getHitEntries(int $year, int $month, HitSort $sort = HitSort::ALL)
 * @method static array getSearchAll(string $queryParam, ?Carbon $dateFrom = null, ?Carbon $dateTo = null, SearchSort $sort = SearchSort::SCORE, SearchVote $votes = SearchVote::HUNDRED, array $domains = [], array $users = [], array $tags = [], ?string $category = null, ?string $bucket = null)
 * @method static array getSearchLinks(string $queryParam, ?Carbon $dateFrom, ?Carbon $dateTo, SearchSort $sort = SearchSort::SCORE, SearchVote $votes = SearchVote::HUNDRED, array $domains = [], array $users = [], array $tags = [], ?string $category = null, ?string $bucket = null, int $page = 1, int $limit = 25)
 * @method static array getSearchEntries(string $queryParam, ?Carbon $dateFrom, ?Carbon $dateTo, SearchSort $sort = SearchSort::SCORE, SearchVote $votes = SearchVote::HUNDRED, array $domains = [], array $users = [], array $tags = [], ?string $category = null, ?string $bucket = null, int $page = 1, int $limit = 25)
 * @method static array getSearchUsers(string $queryParam, SearchUsersSort $sort = SearchUsersSort::SCORE, array $users = [], int $page = 1)
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
