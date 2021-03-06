<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

use App\Models\Acl\Role;
use App\Models\Article;
use App\User;
use Carbon\Carbon;

$factory->define(User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(Article::class, function (Faker\Generator $faker) {

    $user = factory(User::class)->create();

    $role = Role::whereSlug('subscriber')->firstOrFail();
    $user->assignRole($role->id);

    return [
        'user_id' => $user->id,
        'title' => $faker->sentence(8),
        'body' => $body = $faker->paragraph(6),
        'excerpt' => shortenText($body,16),
        'status_active' => 1,
        'status_comment' => 1,
        'is_published' => 1,
        'published_at' => Carbon::now()->subDays(6)->addDays($faker->numberBetween(0,12))
    ];
});





