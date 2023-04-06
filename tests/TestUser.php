<?php

namespace FakeCop\WykopClient\Tests;

use Illuminate\Foundation\Auth\User;

class TestUser extends User
{
    protected $table = 'user';
}