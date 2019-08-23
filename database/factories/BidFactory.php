<?php

/** @var Factory $factory */

use App\Auction;
use App\Bid;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Bid::class, function (Faker $faker) {

    return [
        "value" => rand(1, 1000000000),
        "auction_id" => function () {
            return factory(Auction::class)->create()->id;
        },
        "user_id" => function () {
            return factory(User::class)->create()->id;
        },
    ];
});
