<?php

namespace FakeCop\WykopClient\Api\Requests\Contracts;

enum SearchVote: int
{
    case FIFTY = 50;
    case HUNDRED = 100;
    case FIVE_HUNDRED = 500;
    case THOUSAND = 1000;
}