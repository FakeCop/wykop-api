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

    public static string $accessToken;

    public function __construct()
    {
        $this->initClient();
        $this->refreshClientAccessToken();
    }

    private function initClient(): void
    {
        self::$client = new GuzzleClient(['handler' => $this->getClientStack()]);
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
        ): MessageInterface => isset(self::$accessToken)
            ? $request->withHeader('Authorization', 'Bearer '.$this->getClientAccessToken())
            : $request
        );

        $stack->setHandler(Utils::chooseHandler());
        $stack->push($retryMiddleware);
        $stack->push($authMiddleware);

        return $stack;
    }

    private function refreshClientAccessToken(): void
    {
        if (! isset(self::$accessToken)) {
            self::$accessToken = 'abc';
        }
    }

    /**
     * @return string
     */
    private function getClientAccessToken(): string
    {
        return 'abc';
    }

    /**
     * @param string $path
     * @param array $params
     * @param array $headers
     * @return array|null
     */
    public static function get(string $path, array $params = [], array $headers = []): ?array
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
