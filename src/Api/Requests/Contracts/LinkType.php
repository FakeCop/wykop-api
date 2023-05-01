<?php

namespace FakeCop\WykopClient\Api\Requests\Contracts;

enum LinkType: string
{
    case HOMEPAGE = 'homepage';
    case UPCOMING = 'upcoming';
}