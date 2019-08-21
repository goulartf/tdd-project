<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Auction;
use App\User;
use Faker\Generator as Faker;

$factory->define(Auction::class, function (Faker $faker) {

    $faker->addProvider(new \Faker\Provider\Fakecar($faker));
    $price_estimate = rand(1, 100000);
    $price_start = $price_estimate - ($price_estimate * 0.1);
    $start_data = $faker->dateTimeThisYear();
    $end_date = \Carbon\Carbon::parse($start_data)->addMonth();

    return [
        "title" => $faker->vehicle,
        "description" => $faker->sentence,
        "price_estimate" => $price_estimate,
        "price_start" => $price_start,
        "start_date" => $start_data,
        "end_date" => $end_date,
        "user_id" => function () {
            return factory(App\User::class)->create()->id;
        }
    ];

});
