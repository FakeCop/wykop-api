<?php

namespace FakeCop\WykopClient\Api\Requests\Link;

class LinkUrlRequest extends LinkBasedRequest
{
    protected string $url;

    public function __construct(
        string $url
    ) {
        $this->url = $url;
    }

    public function resolveEndpoint(): string
    {
        return "{$this->urlLinkPrefix}";
    }

    protected function defaultQuery(): array
    {
        return [
            'url' => $this->url,
        ];
    }
}