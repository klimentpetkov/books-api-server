<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;

$factory->define(Category::class, function () {
    return [
        'name' => \Illuminate\Support\Str::random(10)
    ];
});
