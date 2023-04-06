<?php

namespace FakeCop\WykopClient;

use FakeCop\WykopClient\Api\Client as ApiClient;
use FakeCop\WykopClient\DataTransferObjects\LinkSort;
use FakeCop\WykopClient\DataTransferObjects\LinkType;
use FakeCop\WykopClient\DataTransferObjects\UpvoteType;
use FakeCop\WykopClient\Traits\ApiUrlPathTrait;

class WykopClient
{
    use ApiUrlPathTrait;

    private static ApiClient $apiClient;
    
    public function __construct()
    {
        self::$apiClient = new ApiClient();
    }

    /**
     * @param int $page
     * @param \FakeCop\WykopClient\DataTransferObjects\LinkSort|null $sort
     * @param \FakeCop\WykopClient\DataTransferObjects\LinkType|null $type
     * @param string|null $category
     * @param string|null $bucket
     * @return array
     */
    public function getLinks(
        int $page = 1,
        ?LinkSort $sort = null,
        ?LinkType $type = null,
        ?string $category = null,
        ?string $bucket = null,
    ): array
    {
        return self::$apiClient->get('/links');
    }

    /**
     * @param int $linkId
     * @return array
     */
    public function getLinkDetails(int $linkId): array
    {
        return self::$apiClient->get("/links/{$linkId}");
    }

    /**
     * @param int $linkId
     * @param \FakeCop\WykopClient\DataTransferObjects\UpvoteType $upvoteType
     * @return array|null
     */
    public function getLinkUpvotes(
        int $linkId,
        UpvoteType $upvoteType
    )
    {
        return self::$apiClient->get("/links/{$linkId}/upvotes/{$upvoteType}");
    }

    /**
     * @param string $username
     * @return array
     */
    public function getProfileUser(string $username): array
    {
        return self::$apiClient->get(self::profilePath($username));
    }

    /**
     * @param string $username
     * @return array
     */
    public function getProfileUserShort(string $username): array
    {
        return self::$apiClient->get(self::profilePath($username) . '/short');
    }

    /**
     * @param string $username
     * @param int $page
     * @return array
     */
    public function getProfileUserActions(string $username, int $page = 1): array
    {
        return self::$apiClient->get(self::profilePath($username) . '/actions');
    }

    /**
     * @param string $username
     * @param int $page
     * @return array
     */
    public function getProfileUserEntriesAdded(string $username, int $page = 1): array
    {
        return self::$apiClient->get(self::profilePath($username) . '/entries/added');
    }

    /**
     * @param string $username
     * @param int $page
     * @return array
     */
    public function getProfileUserEntriesVoted(string $username, int $page = 1): array
    {
        return self::$apiClient->get(self::profilePath($username) . '/entries/commented');
    }

    /**
     * @param string $username
     * @param int $page
     * @return array
     */
    public function getProfileUserLinksAdded(string $username, int $page = 1): array
    {
        return self::$apiClient->get(self::profilePath($username) . '/links/added');
    }

    /**
     * @param string $username
     * @param int $page
     * @return array
     */
    public function getProfileUserLinksPublished(string $username, int $page = 1): array
    {
        return self::$apiClient->get(self::profilePath($username) . '/links/published');
    }

    /**
     * @param string $username
     * @param int $page
     * @return array
     */
    public function getProfileUserLinksUp(string $username, int $page = 1): array
    {
        return self::$apiClient->get(self::profilePath($username) . '/links/up');
    }

    /**
     * @param string $username
     * @param int $page
     * @return array
     */
    public function getProfileUserLinksDown(string $username, int $page = 1): array
    {
        return self::$apiClient->get(self::profilePath($username) . '/links/down');
    }

    /**
     * @param string $username
     * @param int $page
     * @return array
     */
    public function getProfileUserLinksCommented(string $username, int $page = 1): array
    {
        return self::$apiClient->get(self::profilePath($username) . '/links/commented');
    }

    /**
     * @param string $username
     * @param int $page
     * @return array
     */
    public function getProfileUserObservedUsersFollowing(string $username, int $page = 1): array
    {
        return self::$apiClient->get(self::profilePath($username) . '/observed/users/following');
    }

    /**
     * @param string $username
     * @param int $page
     * @return array
     */
    public function getProfileUserObservedUsersFollowers(string $username, int $page = 1): array
    {
        return self::$apiClient->get(self::profilePath($username) . '/observed/users/followers');
    }
}
