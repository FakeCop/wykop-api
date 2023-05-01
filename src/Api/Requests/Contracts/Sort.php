<?php

namespace FakeCop\WykopClient\Api\Requests\Contracts;

enum Sort: string
{
    case NEWEST = 'newest';
    case ACTIVE = 'active';
    case COMMENTED = 'commented';
    case DIGGED = 'digged';
}