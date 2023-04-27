<?php

namespace FakeCop\WykopClient\Api\Requests;

use Saloon\Http\Request;
use Saloon\Traits\Plugins\AlwaysThrowOnErrors;

abstract class ClientBasedRequest extends Request
{
    use AlwaysThrowOnErrors;
}