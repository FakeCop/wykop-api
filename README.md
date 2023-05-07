<h3>
    <img src="wykop-logo.svg" style="margin-bottom: -8px; margin-right: 8px;" width="150px" alt="wykop.pl"/> <span style="color: #222222;">API Client (V3)</span>
</h3>

###### 🔌 Laravel package

 [Wykop API (V3) Swagger Documentation](https://doc.wykop.pl/)

---  

# 🚀 Fast-track

## Download

`composer require fakecop/wykop-client`

## Install

`php artisan wykop-client:install`

* Config file will be added (_wykop-client.php_)
* Service provider will be registered (_WykopClientServiceProvider.php_)
* **No migrations**
* **No models**
* **No resources**

## Set up environmental variables

```dotenv
WYKOP_API_URL=https://wykop.pl/api/v3
WYKOP_KEY=w123xxxxxxx
WYKOP_SECRET=98a7sd9a8sdxxxxxxxxxxxxxxxxxxx
```
## Have fun!

| `WykopClient` facade available |
|---------------------------------------------------------------------------------------------|

```PHP
use FakeCop\WykopClient\Facades\WykopClient;

...

$data = WykopClient::getProfile('green_martin');

dd($data);
```

Example result:

```text
array:1 [
  "data" => array:23 [
    "username" => "green_martin"
    "gender" => "m"
    "company" => false
    "avatar" => "https://wykop.pl/cdn/c3397992/green_martin_5rDzT7Nqab.jpg"
    ...
```

# 📜 Available actions

## 🧑 Profile actions

```PHP
getProfile(string $username): array;  

getProfileShort(string $username): array;  

getProfileActions(string $username): array;  

getProfileEntriesAdded(string $username): array;  

getProfileEntriesVoted(string $username): array;  

getProfileEntriesCommented(string $username): array;  

getProfileLinksAdded(string $username): array;  

getProfileLinksPublished(string $username): array;  

getProfileLinksUp(string $username): array;  

getProfileLinksDown(string $username): array;  

getProfileLinksCommented(string $username): array;
```

## 🔗 Link actions

```PHP
getLinkList(
    int $page = 1,
    int $limit = 25,
    ?LinkSort $sort = null,
    ?LinkType $type = null,
    ?string $category = null,
    ?string $bucket = null
): array; 

getLinkUrl(string $url): array; 

getLink(int $linkId): array; 

getLinkUpVotes(int $linkId, ActionType $type): array; 

getLinkRedirect(int $linkId): array;

getLinkCommentList(
    int $linkId,
    int $page = 1,
    int $limit = 25,
    ?CommentSort $sort = null,
    bool $ama = false
): array;

getLinkComment(int $linkId, int $commentId): array;

getLinkCommentComments(int $linkId, int $commentId, int $page = 1): array;
```

## 🔥 Hit actions

```PHP
getHitLinks(int $year, int $month, HitSort $sort = HitSort::ALL): array;  

getHitEntries(int $year, int $month, HitSort $sort = HitSort::ALL): array;
```

## 🔍 Search actions

```PHP
getSearchAll(
    string $query,
    ?Carbon $dateFrom = null,
    ?Carbon $dateTo = null,
    SearchSort $sort = SearchSort::SCORE,
    SearchVote $votes = SearchVote::HUNDRED,
    array $domains = [],
    array $users = [],
    array $tags = [],
    ?string $category = null,
    ?string $bucket = null
): array;

getSearchLinks(
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
    int $limit = 25
): array;

getSearchEntries(
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
    int $limit = 25
): array;

getSearchUsers(
    string $query,
    SearchUsersSort $sort = SearchUsersSort::SCORE,
    array $users = [],
    int $page = 1
): array;
```

# 🚧 Available Enums

## LinkSort

```PHP
use FakeCop\WykopClient\Api\Requests\Contracts\LinkSort;

LinkSort::NEWEST;		    //	'newest'
LinkSort::ACTIVE;		    //	'active'
LinkSort::COMMENTED;        //  'commented'
LinkSort::DIGGED;		    //	'digged'
```

## LinkType

```PHP
use FakeCop\WykopClient\Api\Requests\Contracts\LinkType;

LinkType::HOMEPAGE;		//  'homepage'
LinkType::UPCOMING;		//  'upcoming'
```

## CommentSort

```PHP
use FakeCop\WykopClient\Api\Requests\Contracts\CommentSort;

CommentSort::NEWEST;		//  'newest'
CommentSort::OLDEST;		//  'oldest'
CommentSort::BEST;	        //  'best'
```

## ActionType

```PHP
use FakeCop\WykopClient\Api\Requests\Contracts\ActionType;

ActionType::UP;         //  'up'
ActionType::DOWN;       //  'down'
```

## HitSort

```PHP
use FakeCop\WykopClient\Api\Requests\Contracts\HitSort;

HitSort::ALL;		//	'all'
HitSort::DAY;		//	'day'
HitSort::WEEK;		//	'week'
HitSort::MONTH;		//	'month'
HitSort::YEAR;		//	'year'
```

## SearchSort

```PHP
use FakeCop\WykopClient\Api\Requests\Contracts\SearchSort;

SearchSort::SCORE;      //  'score'
SearchSort::POPULAR;    //  'popular'
SearchSort::COMMENTS;   //  'comments'
SearchSort::NEWEST;     //  'newest'
```

## SearchVote

```PHP
use FakeCop\WykopClient\Api\Requests\Contracts\SearchVote;

SearchVote::FIFTY           //  50
SearchVote::HUNDRED         //  100
SearchVote::FIVE_HUNDRED    //  500
SearchVote::THOUSAND;       //  1000
```

## SearchUsersSort

```PHP
use FakeCop\WykopClient\Api\Requests\Contracts\SearchUsersSort;

SearchUsersSort::SCORE          //  'score'
SearchUsersSort::NEWEST         //  'newest'
```