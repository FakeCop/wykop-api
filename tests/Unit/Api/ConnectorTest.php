<?php

namespace FakeCop\WykopClient\Tests\Unit\Api;

use FakeCop\WykopClient\Api\Connector;
use FakeCop\WykopClient\Api\Requests\AuthRequest;
use FakeCop\WykopClient\Api\Requests\Profile\ProfileRequest;
use FakeCop\WykopClient\Tests\TestCase;
use Illuminate\Support\Facades\Session;

final class ConnectorTest extends TestCase
{
    public function testClientConstructor(): void
    {
        if (Session::has('wykopAccessToken')) {
            echo 'Wykop AccessToken found in session: ' . Session::get('wykopAccessToken') . PHP_EOL;
        } else {
            $request = new AuthRequest;
            $request->body()->merge([
                'data' => [
                    'key' => config('wykop-client.key'),
                    'secret' => config('wykop-client.secret'),
                ]
            ]);

            $response = $request->send();

            $jsonBody = $response->json();

            Session::put('wykopAccessToken', $jsonBody['data']['token']);
        }

        $connector = new Connector(Session::get('wykopAccessToken'));
        $response = $connector->send(new ProfileRequest('green_martin'));

        $this->assertEquals('green_martin', $response->json('data.username'));
    }
}