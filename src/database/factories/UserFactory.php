<?php
$this->factory->define(\User\Model\User::class, function (\Faker\Generator $faker) {
    return [
        'email'    => $faker->email,
         'forename' => $faker->firstName(255),
         'surname'    => $faker->lastName(255)
    ];
});