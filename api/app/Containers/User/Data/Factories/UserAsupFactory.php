<?php
use Faker\Generator as Faker;
use App\Containers\User\Models\UserAsup;
use Illuminate\Database\Eloquent\Factory;

/** @var Factory $factory */
$factory->define(UserAsup::class, static function (Faker $faker) {
  $gender = $faker->randomElement(['male', 'female']);

  return [
      'integration_id'     => sprintf('%d-%d-%d %d', random_int(100, 999), random_int(100, 999), random_int(100, 999), random_int(10, 99)),
      'number'       => $faker->unique()->randomNumber(6, true),
      'email'       => sprintf('user%d@nor.com', random_int(1000, 1000000)),
      'fullname'    => vsprintf('%s %s %s', [$faker->lastName($gender), $faker->firstName($gender), $faker->middleName($gender)]),
    ];
});
