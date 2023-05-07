<?php

namespace FakeCop\WykopClient;

use Exception;
use FakeCop\WykopClient\Api\Requests\AuthRequest;
use FakeCop\WykopClient\Api\Requests\Contracts\ActionType;
use FakeCop\WykopClient\Api\Requests\Contracts\CommentSort;
use FakeCop\WykopClient\Api\Requests\Contracts\HitSort;
use FakeCop\WykopClient\Api\Requests\Contracts\LinkType;
use FakeCop\WykopClient\Api\Requests\Contracts\LinkSort;
use FakeCop\WykopClient\Api\Requests\Contracts\SearchSort;
use FakeCop\WykopClient\Api\Requests\Contracts\SearchUsersSort;
use FakeCop\WykopClient\Api\Requests\Contracts\SearchVote;
use FakeCop\WykopClient\Api\Requests\Hit\HitEntriesRequest;
use FakeCop\WykopClient\Api\Requests\Hit\HitLinksRequest;
use FakeCop\WykopClient\Api\Requests\Link\LinkCommentCommentsRequest;
use FakeCop\WykopClient\Api\Requests\Link\LinkCommentListRequest;
use FakeCop\WykopClient\Api\Requests\Link\LinkCommentRequest;
use FakeCop\WykopClient\Api\Requests\Link\LinkListRequest;
use FakeCop\WykopClient\Api\Requests\Link\LinkRedirectRequest;
use FakeCop\WykopClient\Api\Requests\Link\LinkRelatedRequest;
use FakeCop\WykopClient\Api\Requests\Link\LinkRequest;
use FakeCop\WykopClient\Api\Requests\Link\LinkUpVotesRequest;
use FakeCop\WykopClient\Api\Requests\Link\LinkUrlRequest;
use FakeCop\WykopClient\Api\Requests\Profile\ProfileActionsRequest;
use FakeCop\WykopClient\Api\Requests\Profile\ProfileEntriesAddedRequest;
use FakeCop\WykopClient\Api\Requests\Profile\ProfileEntriesCommentedRequest;
use FakeCop\WykopClient\Api\Requests\Profile\ProfileEntriesVotedRequest;
use FakeCop\WykopClient\Api\Requests\Profile\ProfileLinksAddedRequest;
use FakeCop\WykopClient\Api\Requests\Profile\ProfileLinksCommentedRequest;
use FakeCop\WykopClient\Api\Requests\Profile\ProfileLinksDownRequest;
use FakeCop\WykopClient\Api\Requests\Profile\ProfileLinksPublishedRequest;
use FakeCop\WykopClient\Api\Requests\Profile\ProfileLinksUpRequest;
use FakeCop\WykopClient\Api\Requests\Profile\ProfileRequest;
use FakeCop\WykopClient\Api\Requests\Profile\ProfileShortRequest;
use FakeCop\WykopClient\Api\Requests\Search\SearchAllRequest;
use FakeCop\WykopClient\Api\Requests\Search\SearchEntriesRequest;
use FakeCop\WykopClient\Api\Requests\Search\SearchLinksRequest;
use FakeCop\WykopClient\Api\Requests\Search\SearchUsersRequest;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\Statuses\ForbiddenException;
use Saloon\Exceptions\Request\Statuses\NotFoundException;
use Saloon\Exceptions\Request\Statuses\RequestTimeOutException;
use Saloon\Exceptions\Request\Statuses\TooManyRequestsException;
use Saloon\Exceptions\Request\Statuses\UnauthorizedException;
use Saloon\Exceptions\Request\Statuses\UnprocessableEntityException;
use Saloon\Http\Connector;
use Saloon\Http\Request;

class WykopClient
{
    private static Connector $connector;

    public function __construct()
    {
        $this->initConnector();
    }

    private function initConnector(): void
    {
        if (! Session::has('wykopAccessToken')) {
            $this->refreshAccessToken();
        }

        self::$connector = new Api\Connector(Session::get('wykopAccessToken'));
    }

    private function refreshAccessToken(): void
    {
        $request = new AuthRequest;
        $request->body()->merge([
            'data' => [
                'key' => config('wykop-client.key'),
                'secret' => config('wykop-client.secret'),
            ],
        ]);

        try {
            $jsonBody = $request->send()->json();
            Session::put('wykopAccessToken', $jsonBody['data']['token']);
        } catch (Exception $exception) {
            // @TODO
        }
    }

    /**
     * @param \Saloon\Http\Request $request
     * @return array
     */
    private function sendConnectorAction(Request $request): array
    {
        try {
            $response = self::$connector->send($request);

            return $response->json();
        } catch (UnauthorizedException $exception) { // 401

        } catch (ForbiddenException $exception) { // 403
            // @TODO reauthenticate
        } catch (NotFoundException $exception) { // 404

        } catch (RequestTimeOutException $exception) { // 408

        } catch (UnprocessableEntityException $exception) { // 422

        } catch (TooManyRequestsException $exception) { // 429

        } catch (FatalRequestException $exception) {
        } catch (Exception $exception) {
            return [];
        }

        return [];
    }

    /**
     * @param string $username
     * @return array
     */
    public function getProfile(string $username): array
    {
        return $this->sendConnectorAction(new ProfileRequest($username));
    }

    /**
     * @param string $username
     * @return array
     */
    public function getProfileShort(string $username): array
    {
        return $this->sendConnectorAction(new ProfileShortRequest($username));
    }

    /**
     * @param string $username
     * @return array
     */
    public function getProfileActions(string $username): array
    {
        return $this->sendConnectorAction(new ProfileActionsRequest($username));
    }

    /**
     * @param string $username
     * @return array
     */
    public function getProfileEntriesAdded(string $username): array
    {
        return $this->sendConnectorAction(new ProfileEntriesAddedRequest($username));
    }

    /**
     * @param string $username
     * @return array
     */
    public function getProfileEntriesVoted(string $username): array
    {
        return $this->sendConnectorAction(new ProfileEntriesVotedRequest($username));
    }

    /**
     * @param string $username
     * @return array
     */
    public function getProfileEntriesCommented(string $username): array
    {
        return $this->sendConnectorAction(new ProfileEntriesCommentedRequest($username));
    }

    /**
     * @param string $username
     * @return array
     */
    public function getProfileLinksAdded(string $username): array
    {
        return $this->sendConnectorAction(new ProfileLinksAddedRequest($username));
    }

    /**
     * @param string $username
     * @return array
     */
    public function getProfileLinksPublished(string $username): array
    {
        return $this->sendConnectorAction(new ProfileLinksPublishedRequest($username));
    }

    /**
     * @param string $username
     * @return array
     */
    public function getProfileLinksUp(string $username): array
    {
        return $this->sendConnectorAction(new ProfileLinksUpRequest($username));
    }

    /**
     * @param string $username
     * @return array
     */
    public function getProfileLinksDown(string $username): array
    {
        return $this->sendConnectorAction(new ProfileLinksDownRequest($username));
    }

    /**
     * @param string $username
     * @return array
     */
    public function getProfileLinksCommented(string $username): array
    {
        return $this->sendConnectorAction(new ProfileLinksCommentedRequest($username));
    }

    /**
     * @param int $page
     * @param int $limit
     * @param \FakeCop\WykopClient\Api\Requests\Contracts\LinkSort|null $sort
     * @param \FakeCop\WykopClient\Api\Requests\Contracts\LinkType|null $type
     * @param string|null $category
     * @param string|null $bucket
     * @return array
     */
    public function getLinkList(
        int $page = 1,
        int $limit = 25,
        ?LinkSort $sort = null,
        ?LinkType $type = null,
        ?string $category = null,
        ?string $bucket = null
    ): array {
        return $this->sendConnectorAction(new LinkListRequest($page, $limit, $sort, $type, $category, $bucket));
    }

    /**
     * @param string $url
     * @return array
     */
    public function getLinkUrl(string $url): array
    {
        return $this->sendConnectorAction(new LinkUrlRequest($url));
    }

    /**
     * @param int $linkId
     * @return array
     */
    public function getLink(int $linkId): array
    {
        return $this->sendConnectorAction(new LinkRequest($linkId));
    }

    /**
     * @param int $linkId
     * @param \FakeCop\WykopClient\Api\Requests\Contracts\ActionType $type
     * @return array
     */
    public function getLinkUpVotes(int $linkId, ActionType $type): array
    {
        return $this->sendConnectorAction(new LinkUpVotesRequest($linkId, $type));
    }

    /**
     * @param int $linkId
     * @return array
     */
    public function getLinkRedirect(int $linkId): array
    {
        return $this->sendConnectorAction(new LinkRedirectRequest($linkId));
    }

    /**
     * @param int $linkId
     * @return array
     */
    public function getLinkRelated(int $linkId): array
    {
        return $this->sendConnectorAction(new LinkRelatedRequest($linkId));
    }

    /**
     * @param int $linkId
     * @param int $page
     * @param int $limit
     * @param \FakeCop\WykopClient\Api\Requests\Contracts\CommentSort|null $sort
     * @param bool $ama
     * @return array
     */
    public function getLinkCommentList(
        int $linkId,
        int $page = 1,
        int $limit = 25,
        ?CommentSort $sort = null,
        bool $ama = false,
    ): array {
        return $this->sendConnectorAction(new LinkCommentListRequest($linkId, $page, $limit, $sort, $ama));
    }

    /**
     * @param int $linkId
     * @param int $commentId
     * @return array
     */
    public function getLinkComment(int $linkId, int $commentId): array
    {
        return $this->sendConnectorAction(new LinkCommentRequest($linkId, $commentId));
    }

    /**
     * @param int $linkId
     * @param int $commentId
     * @param int $page
     * @return array
     */
    public function getLinkCommentComments(int $linkId, int $commentId, int $page = 1): array
    {
        return $this->sendConnectorAction(new LinkCommentCommentsRequest($linkId, $commentId, $page));
    }

    /**
     * @param int $year
     * @param int $month
     * @param \FakeCop\WykopClient\Api\Requests\Contracts\HitSort $sort
     * @return array
     */
    public function getHitLinks(int $year, int $month, HitSort $sort = HitSort::ALL): array
    {
        return $this->sendConnectorAction(new HitLinksRequest($year, $month, $sort));
    }

    /**
     * @param int $year
     * @param int $month
     * @param \FakeCop\WykopClient\Api\Requests\Contracts\HitSort $sort
     * @return array
     */
    public function getHitEntries(int $year, int $month, HitSort $sort = HitSort::ALL): array
    {
        return $this->sendConnectorAction(new HitEntriesRequest($year, $month, $sort));
    }

    /**
     * @param string $query
     * @param \Illuminate\Support\Carbon|null $dateFrom
     * @param \Illuminate\Support\Carbon|null $dateTo
     * @param \FakeCop\WykopClient\Api\Requests\Contracts\SearchSort $sort
     * @param \FakeCop\WykopClient\Api\Requests\Contracts\SearchVote $votes
     * @param array $domains
     * @param array $users
     * @param array $tags
     * @param string|null $category
     * @param string|null $bucket
     * @return array
     */
    public function getSearchAll(
        string $query,
        ?Carbon $dateFrom = null,
        ?Carbon $dateTo = null,
        SearchSort $sort = SearchSort::SCORE,
        SearchVote $votes = SearchVote::HUNDRED,
        array $domains = [],
        array $users = [],
        array $tags = [],
        ?string $category = null,
        ?string $bucket = null,
    ): array {
        return $this->sendConnectorAction(new SearchAllRequest($query, $dateFrom, $dateTo, $sort, $votes, $domains, $users, $tags, $category, $bucket));
    }

    /**
     * @param string $query
     * @param \Illuminate\Support\Carbon|null $dateFrom
     * @param \Illuminate\Support\Carbon|null $dateTo
     * @param \FakeCop\WykopClient\Api\Requests\Contracts\SearchSort $sort
     * @param \FakeCop\WykopClient\Api\Requests\Contracts\SearchVote $votes
     * @param array $domains
     * @param array $users
     * @param array $tags
     * @param string|null $category
     * @param string|null $bucket
     * @param int $page
     * @param int $limit
     * @return array
     */
    public function getSearchLinks(
        string $query,
        ?Carbon $dateFrom = null,
        ?Carbon $dateTo = null,
        SearchSort $sort = SearchSort::SCORE,
        SearchVote $votes = SearchVote::HUNDRED,
        array $domains = [],
        array $users = [],
        array $tags = [],
        ?string $category = null,
        ?string $bucket = null,
        int $page = 1,
        int $limit = 25,
    ): array {
        return $this->sendConnectorAction(new SearchLinksRequest($query, $dateFrom, $dateTo, $sort, $votes, $domains, $users, $tags, $category, $bucket, $page, $limit));
    }

    /**
     * @param string $query
     * @param \Illuminate\Support\Carbon|null $dateFrom
     * @param \Illuminate\Support\Carbon|null $dateTo
     * @param \FakeCop\WykopClient\Api\Requests\Contracts\SearchSort $sort
     * @param \FakeCop\WykopClient\Api\Requests\Contracts\SearchVote $votes
     * @param array $domains
     * @param array $users
     * @param array $tags
     * @param string|null $category
     * @param string|null $bucket
     * @param int $page
     * @param int $limit
     * @return array
     */
    public function getSearchEntries(
        string $query,
        ?Carbon $dateFrom = null,
        ?Carbon $dateTo = null,
        SearchSort $sort = SearchSort::SCORE,
        SearchVote $votes = SearchVote::HUNDRED,
        array $domains = [],
        array $users = [],
        array $tags = [],
        ?string $category = null,
        ?string $bucket = null,
        int $page = 1,
        int $limit = 25,
    ): array
    {
        return $this->sendConnectorAction(new SearchEntriesRequest($query, $dateFrom, $dateTo, $sort, $votes, $domains, $users, $tags, $category, $bucket, $page, $limit));
    }

    /**
     * @param string $query
     * @param \FakeCop\WykopClient\Api\Requests\Contracts\SearchUsersSort $sort
     * @param array $users
     * @param int $page
     * @return array
     */
    public function getSearchUsers(
        string $query,
        SearchUsersSort $sort = SearchUsersSort::SCORE,
        array $users = [],
        int $page = 1,
    ): array {
        return $this->sendConnectorAction(new SearchUsersRequest($query, $sort, $users, $page));
    }
}
