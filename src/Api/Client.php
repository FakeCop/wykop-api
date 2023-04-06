<?php

namespace FakeCop\WykopClient\Api;

use Exception;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Utils;
use Illuminate\Support\Facades\Log;
use Psr\Http\Message\MessageInterface;
use GuzzleHttp\Client as GuzzleClient;

class Client
{
    /* Max entries after which the clients retry middleware will give up retrying */
    private const MAX_RETRIES = 1;

    public static GuzzleClient $client;

    public string $accessToken;

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function __construct()
    {
        self::$client = new GuzzleClient([
            'base_uri' => config('wykop-client.api_url').'/',
            'handler' => $this->getClientStack(),
        ]);

        $this->refreshClientAccessToken();
    }

    /**
     * @return \GuzzleHttp\HandlerStack
     */
    private function getClientStack(): HandlerStack
    {
        $stack = new HandlerStack();

        // Retry Middleware - to handle auth refresh token action
        $retryMiddleware = Middleware::retry(function (
            $retries,
            Request $request,
            Response $response = null,
            RequestException $exception = null
        ) {
            if ($retries >= self::MAX_RETRIES) {
                return false;
            }

            if ($response && $response->getStatusCode() === 401) {
                $this->refreshClientAccessToken();

                return true;
            }

            return false;
        });

        // Auth Middleware - to append auth token automatically
        $authMiddleware = Middleware::mapRequest(fn(Request $request
        ): MessageInterface => isset($this->accessToken) ? $request->withHeader('Authorization', 'Bearer '.$this->accessToken) : $request);

        $stack->setHandler(Utils::chooseHandler());
        $stack->push($retryMiddleware);
        $stack->push($authMiddleware);

        return $stack;
    }

    /**
     * @return void
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function refreshClientAccessToken(): void
    {
        $this->accessToken = ! isset($this->accessToken) ? $this->getInitialAuthToken() : $this->getRefreshAuthToken();
    }

    /**
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function getInitialAuthToken(): string
    {
        $response = self::$client->post('auth', [
                'json' => [
                    'data' => [
                        'key' => config('wykop-client.key'),
                        'secret' => config('wykop-client.secret'),
                    ],
                ],
            ]);

        $contents = json_decode($response->getBody()->getContents(), true);

        return $contents['data']['token'];
    }

    /**
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function getRefreshAuthToken(): string
    {
        $response = self::$client->post('auth', [
            'json' => [
                'data' => [
                    'refresh_token' => config('wykop-client.key'),
                    'secret' => config('wykop-client.secret'),
                ]
            ]
            ]);

        $contents = json_decode($response->getBody()->getContents(), true);

        return $contents['data']['token'];
    }

    /**
     * @param string $path
     * @param array $params
     * @param array $headers
     * @return array|null
     */
    public function get(string $path, array $params = [], array $headers = []): ?array
    {
        try {
            $response = self::$client->get($path, [
                'headers' => $headers,
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (GuzzleException $exception) {
            Log::error($exception->getMessage());
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
        }

        return null;
    }
}
