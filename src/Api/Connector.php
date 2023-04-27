<?php

namespace FakeCop\WykopClient\Api;

class Connector extends \Saloon\Http\Connector
{
    public function __construct(string $accessToken)
    {
        $this->withTokenAuth($accessToken);
    }

    public function resolveBaseUrl(): string
    {
        return config('wykop-client.api_url');
    }

    protected function defaultHeaders(): array
    {
        return [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ];
    }

    protected function defaultConfig(): array
    {
        return [
            'timeout' => 60,
        ];
    }

    protected function defaultQuery(): array
    {
        return [
            'per_page' => 25,
        ];
    }
}