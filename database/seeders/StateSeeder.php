<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $states = [
            0 => [
                "name" => "Acre",
                "acronym" => "AC",
                "priceHour" => 0.828
            ],
            1 => [
                "name" => "Alagoas",
                "acronym" => "AL",
                "priceHour" => 0.866
            ],
            2 => [
                "name" => "Amapá",
                "acronym" => "AP",
                "priceHour" => 0.835
            ],
            3 => [
                "name" => "Amazonas",
                "acronym" => "AM",
                "priceHour" => 0.835
            ],
            4 => [
                "name" => "Ceará",
                "acronym" => "CE",
                "priceHour" => 0.744
            ],
            5 => [
                "name" => "Distrito Federal",
                "acronym" => "DF",
                "priceHour" => 0.766
            ],
            6 => [
                "name" => "Espírito Santo",
                "acronym" => "ES",
                "priceHour" => 0.696
            ],
            7 => [
                "name" => "Goiás",
                "acronym" => "GO",
                "priceHour" => 0.711
            ],
            8 => [
                "name" => "Maranhão",
                "acronym" => "MA",
                "priceHour" => 0.719
            ],
            9 => [
                "name" => "Mato Grosso",
                "acronym" => "MT",
                "priceHour" => 0.847
            ],
            10 => [
                "name" => "Mato Grosso do Sul",
                "acronym" => "MS",
                "priceHour" => 0.870
            ],
            11 => [
                "name" => "Minas Gerais",
                "acronym" => "MG",
                "priceHour" => 0.751
            ],
            12 => [
                "name" => "Pará",
                "acronym" => "PA",
                "priceHour" => 0.962
            ],
            13 => [
                "name" => "Paraíba",
                "acronym" => "PB",
                "priceHour" => 0.602
            ],
            14 => [
                "name" => "Paraná",
                "acronym" => "PR",
                "priceHour" => 0.630
            ],
            15 => [
                "name" => "Pernambuco",
                "acronym" => "PE",
                "priceHour" => 0.764
            ],
            16 => [
                "name" => "Piauí",
                "acronym" => "PI",
                "priceHour" => 0.854
            ],
            17 => [
                "name" => "Rio de Janeiro",
                "acronym" => "RJ",
                "priceHour" => 0.872
            ],
            18 => [
                "name" => "Rio Grande do Norte",
                "acronym" => "RN",
                "priceHour" => 0.689
            ],
            19 => [
                "name" => "Rio Grande do Sul",
                "acronym" => "RS",
                "priceHour" => 0.688
            ],
            20 => [
                "name" => "Rondônia",
                "acronym" => "RO",
                "priceHour" => 0.709
            ],
            21 => [
                "name" => "Roraima",
                "acronym" => "RR",
                "priceHour" => 0.661
            ],
            22 => [
                "name" => "Santa Catarina",
                "acronym" => "SC",
                "priceHour" => 0.597
            ],
            23 => [
                "name" => "São Paulo",
                "acronym" => "SP",
                "priceHour" => 0.684
            ],
            24 => [
                "name" => "Sergipe",
                "acronym" => "SE",
                "priceHour" => 0.618
            ],
            25 => [
                "name" => "Tocantins",
                "acronym" => "TO",
                "priceHour" => 0.756
            ]
        ];


        for($i = 0; $i < 26; $i++) {
            DB::table("states")->insert([
                "state_name" => $states[$i]["name"],
                "state_acronym" => $states[$i]["acronym"],
                "kiloWh_hour" => $states[$i]["priceHour"]
            ]);
        }
    }
}
