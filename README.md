<h3>
    <img src="wykop-logo.svg" style="margin-bottom: -8px; margin-right: 8px;" width="150px" alt="wykop.pl"/> <span style="color: #222222;">API Client (V3)</span>
</h3>

###### 🔌 Laravel package

 [Wykop API (V3) Swagger Documentation](https://doc.wykop.pl/)

---  

### 🚀 Fast-track

#### Download

`composer require fakecop/wykop-client`

#### Install

`php artisan wykop-client:install`

* Config file will be added (_wykop-client.php_)
* Service provider will be registered (_WykopClientServiceProvider.php_)
* **No migrations**
* **No models**
* **No resources**

#### Set up environmental variables

```dotenv
WYKOP_API_URL=https://wykop.pl/api/v3
WYKOP_KEY=w123xxxxxxx
WYKOP_SECRET=98a7sd9a8sdxxxxxxxxxxxxxxxxxxx
```
#### Have fun!

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

### 📜 Available actions

#### Profile actions

```PHP
static array getProfile(string $username)  

static array getProfileShort(string $username)  

static array getProfileActions(string $username)  

static array getProfileEntriesAdded(string $username)  

static array getProfileEntriesVoted(string $username)  

static array getProfileEntriesCommented(string $username)  

static array getProfileLinksAdded(string $username)  

static array getProfileLinksPublished(string $username)  

static array getProfileLinksUp(string $username)  

static array getProfileLinksDown(string $username)  

static array getProfileLinksCommented(string $username)
```

