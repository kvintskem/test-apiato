<?php
/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Containers\User\Models\User::class, static function (Faker\Generator $faker) {
  return [
    'integration_id' => sprintf('%d-%d-%d %d', random_int(100, 999), random_int(100, 999), random_int(100, 999), random_int(10, 99)),
    'type'    => 'user',
  ];
});
