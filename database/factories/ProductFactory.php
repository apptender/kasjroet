<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */


use App\Brand;
use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        //brand, categories, kosher, koshertype, eancode, productname
        'productname' => $faker->name,
        'kosher' => (bool)random_int(0, 1),
        'koshertype' => $faker->name,
        'brand_id' => function() {
            return factory(Brand::class)->create()->id;
        }
    ];
});
