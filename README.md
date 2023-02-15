# WYKOP API CLIENT (V3)
### Laravel package

# 🏗️
#### ⚠️⚠️⚠️ This Client is still WIP ⚠️⚠️⚠

---  

## ️Methods

`use FakeCop\WykopClient\Facades\WykopClient`

```PHP
static array getProfileUser(string $username)
static array getProfileUserShort(string $username)
static array getProfileUserActions(string $username, int $page)
static array getProfileUserEntriesVoted(string $username, int $page)
static array getProfileUserLinksAdded(string $username, int $page)
static array getProfileUserLinksPublished(string $username, int $page)
static array getProfileUserLinksUp(string $username, int $page)
static array getProfileUserLinksDown(string $username, int $page)
static array getProfileUserLinksCommented(string $username, int $page)
static array getProfileUserObservedUsersFollowing(string $username, int $page)
static array getProfileUserObservedUsersFollowers(string $username, int $page)
```

## DTOs

### FakeCop\WykopClient\DataTransferObjects\Profile\Profile
```PHP
string $username,
bool $company,
FakeCop\WykopClient\DataTransferObjects\Gender $gender,
string $avatar,
bool $note,
bool $online,
string $status,
FakeCop\WykopClient\DataTransferObjects\Color $color,
bool $verified,
bool $follow,
FakeCop\WykopClient\DataTransferObjects\Profile\Rank $rank,
FakeCop\WykopClient\DataTransferObjects\Profile\Actions $actions,
string $name,
string $city,
string $website,
string $about,
string $public_email,
string $background,
int $followers,
Carbon $member_since,
FakeCop\WykopClient\DataTransferObjects\Profile\Summary $summary,
FakeCop\WykopClient\DataTransferObjects\Profile\SocialMedia $social_media,
FakeCop\WykopClient\DataTransferObjects\Profile\Banned $banned,
bool $can_change_gender,
```