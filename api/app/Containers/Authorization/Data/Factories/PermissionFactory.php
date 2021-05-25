<?php
/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Containers\Authorization\Models\Permission;

$factory->define(Permission::class, static function(Faker\Generator $faker) {
    return [
        'name' => 'super.permission',
        'guard_name' => 'api',
    ];
});
