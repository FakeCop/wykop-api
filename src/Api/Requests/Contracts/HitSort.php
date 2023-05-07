<?php

namespace FakeCop\WykopClient\Api\Requests\Contracts;

enum HitSort: string
{
    case ALL = 'all';
    case DAY = 'day';
    case WEEK = 'week';
    case MONTH = 'month';
    case YEAR = 'year';
}