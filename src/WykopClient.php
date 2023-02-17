<?php

namespace FakeCop\WykopClient;

use FakeCop\WykopClient\Api\Client as ApiClient;
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
