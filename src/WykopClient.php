<?php

namespace FakeCop\WykopClient;

use Exception;
use FakeCop\WykopClient\Api\Requests\AuthRequest;
use FakeCop\WykopClient\Api\Requests\Profile\ProfileRequest;
use FakeCop\WykopClient\Api\Requests\Profile\ProfileShortRequest;
use Illuminate\Support\Facades\Session;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
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
        if (!Session::has('wykopAccessToken')) {
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
            ]
        ]);

        try {
            $jsonBody = $request->send()->json();
            Session::put('wykopAccessToken', $jsonBody['data']['token']);
        }
        catch (Exception $exception) {
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
        }
        catch (UnauthorizedException $exception) { // 401

        }
        catch (ForbiddenException $exception) { // 403
            // @TODO reauthenticate
        }
        catch (NotFoundException $exception) { // 404

        }
        catch (RequestTimeOutException $exception) { // 408

        }
        catch (UnprocessableEntityException $exception) { // 422

        }
        catch (TooManyRequestsException $exception) { // 429

        }
        catch (FatalRequestException $exception) {

        }
        catch (Exception $exception) {
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
}
