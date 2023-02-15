<?php

namespace FakeCop\WykopClient\DataTransferObjects\Profile;

use FakeCop\WykopClient\Casts\GenderCast;
use FakeCop\WykopClient\DataTransferObjects\Gender;
use FakeCop\WykopClient\DataTransferObjects\Color;
use Illuminate\Support\Carbon;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Data;

class Profile extends Data
{
    public function __construct(
        public string $username,
        public bool $company,
        #[WithCast(GenderCast::class)]
        public Gender $gender,
        public string $avatar,
        public bool $note,
        public bool $online,
        public string $status,
        public Color $color,
        public bool $verified,
        public bool $follow,
        public Rank $rank,
        public Actions $actions,
        public string $name,
        public string $city,
        public string $website,
        public string $about,
        public string $public_email,
        public string $background,
        public int $followers,
        #[WithCast(DateTimeInterfaceCast::class)]
        public Carbon $member_since,
        public Summary $summary,
        public SocialMedia $social_media,
        public Banned $banned,
        public bool $can_change_gender,
    )
    {
    }
}