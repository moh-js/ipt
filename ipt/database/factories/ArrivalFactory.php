<?php

use Faker\Generator as Faker;

$factory->define(App\Arrival::class, function (Faker $faker) {

	$rand   = ['archtecture', 'computer', 'civil', 'mechanical', 'electrical', 'lab'];
	$region = ['Arusha', 'Dar es Salaam', 'Morogoro', 'Dodoma', 'Kagera', 'Iringa', 'Mbeya', 'Mwanza', 'Mtwara', 'Tanga', 'Rukwa', 'Coast', 'Geita', 'Katavi', 'Kigoma', 'Kilimanjaro', 'Lindi', 'Manyara', 'Mara', 'Njombe', 'Pemba North', 'Pemba South', 'Ruvuma', 'Shinyanga','Simiyu', 'Singida', 'Songwe', 'Tabora', 'Zanzibar North'];
	$name   = ['Azam', 'TBC', 'SimbaNet', 'Telnet', 'Tanesco', 'TBL', 'TBS', 'Clouds', 'Tigo', 'Airtel', 'Zantel', 'Vodacom', 'TTCL'];

    return [
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        },
        'industry_name' => $name[array_rand($name)],
        'phone' => rand(111111111,999999999),
        'phone_super' => rand(111111111,999999999),
        'department' => $rand[array_rand($rand)],
        'placement' => 0,
        'placement_id' => 0,
        'region' => $region[array_rand($region)],
        'district' => 'Null'
    ];
});
