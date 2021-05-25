<?php
/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\App\Containers\Authentication\Models\Auth::class, static function(Faker\Generator $faker) {
  return [
    'password' => Illuminate\Support\Facades\Hash::make(env('DEFAULT_PASSWORD'))
  ];
});
