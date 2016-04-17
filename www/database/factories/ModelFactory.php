<?php

use App\User;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Product;
use Faker\Generator as Faker;

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

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->word(),
        'description' => $faker->paragraph($sentences = 3),
    ];
});

$factory->define(Post::class, function (Faker $faker) {
    return [
        CreateUsersTable::FK => User::all()->random()->{CreateUsersTable::PK},
        CreateCategoriesTable::FK => Category::all()->random()->{CreateCategoriesTable::PK},
        'title' => $faker->sentence($words = 3),
        'content' => $faker->paragraph($sentences = 3),
    ];
});

$factory->define(Product::class, function (Faker $faker) {
    return [
        CreateUsersTable::FK => User::all()->random()->{CreateUsersTable::PK},
        CreateCategoriesTable::FK => Category::all()->random()->{CreateCategoriesTable::PK},
        'title' => $faker->sentence($words = 1),
        'content' => $faker->paragraph($sentences = 3),
    ];
});

$factory->define(Tag::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->word(),
        'description' => $faker->paragraph($sentences = 3),
    ];
});

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => Hash::make($faker->password(6, 20)),
        'remember_token' => str_random(10),
        'given_name' => $faker->firstName,
        'family_name' => $faker->lastName,
    ];
});