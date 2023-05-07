<?php

namespace FakeCop\WykopClient\Api\Requests\Contracts;

enum SearchUsersSort: string
{
    case SCORE = 'score';
    case NEWEST = 'newest';
}