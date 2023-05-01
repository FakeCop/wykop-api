<?php

namespace FakeCop\WykopClient\Api\Requests\Contracts;

enum LinkSort: string
{
    case NEWEST = 'newest';
    case ACTIVE = 'active';
    case COMMENTED = 'commented';
    case DIGGED = 'digged';
}