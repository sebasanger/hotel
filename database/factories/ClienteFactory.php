<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Cliente;
use Faker\Generator as Faker;

$factory->define(Cliente::class, function (Faker $faker) {
    return [
        'nombre' => $faker->firstName,
        'apellido' => $faker->lastName,
        'dni' => $faker->numberBetween(30000000, 50000000),
        'fechaNacimiento' => $faker->dateTimeBetween('-30 years', '-5 years'),
        'celular' => $faker->phoneNumber,
        'email' => $faker->unique()->safeEmail,
        'cuit' => $faker->numberBetween(30000000, 50000000),
        'created_at' => now(),
        'facturas_id' => $faker->numberBetween(1,4)
    ];
});
