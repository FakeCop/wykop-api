<?php

namespace FakeCop\WykopClient\Api\Requests\Contracts;

enum ActionType: string
{
    case UP = 'up';
    case DOWN = 'down';
}