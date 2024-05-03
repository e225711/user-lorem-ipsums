<?php

namespace Helpers;

use Faker\Factory;
use Models\User;

class RandomGenerator
{
    private static $faker;

    private static function getFaker()
    {
        if (!self::$faker) {
            self::$faker = Factory::create();
        }
        return self::$faker;
    }

    public static function user(): User
    {
        $faker = self::getFaker();

        return new User(
            $faker->randomNumber(),
            $faker->firstName(),
            $faker->lastName(),
            $faker->email(),
            $faker->password(),
            $faker->phoneNumber(),
            $faker->address(),
            $faker->dateTimeThisCentury(),
            $faker->dateTimeBetween('-10 years', '+20 years'),
            $faker->randomElement(['admin', 'user', 'editor'])
        );
    }

    public static function users(int $min, int $max): array
    {
        $faker = self::getFaker();
        $users = [];
        $numOfUsers = $faker->numberBetween($min, $max);

        for ($i = 0; $i < $numOfUsers; $i++) {
            $users[] = self::user();
        }

        return $users;
    }
}
