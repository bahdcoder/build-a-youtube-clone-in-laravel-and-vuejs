<?php

use Faker\Generator as Faker;
use Laratube\Video;
use Laratube\Channel;

$factory->define(Video::class, function (Faker $faker) {
    return [
        'channel_id' => function() {
            return factory(Channel::class)->create()->id;
        },
        'views' => $faker->numberBetween(1, 1000),
        'thumbnail' => $faker->imageUrl(),
        'percentage' => 100,
        'title' => $faker->sentence(4),
        'description' => $faker->sentence(10),
        'path' => $faker->word()
    ];
});
