<?php

namespace FakeCop\WykopClient\Api\Requests\Contracts;

enum SearchSort: string
{
    case SCORE = 'score';
    case POPULAR = 'popular';
    case COMMENTS = 'comments';
    case NEWEST = 'newest';
}