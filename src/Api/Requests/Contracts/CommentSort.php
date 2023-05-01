<?php

namespace FakeCop\WykopClient\Api\Requests\Contracts;

enum CommentSort: string
{
    case NEWEST = 'newest';
    case OLDEST = 'oldest';
    case BEST = 'best';
}