<?php

use Illuminate\Database\Seeder;

class StablishmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stablishments = [
          [
            'name' => 'NetPlay Ruby',
            'city' => 'Maracaibo',
            'Address' => 'La lago'
          ],
          [
            'name' => 'NetPlay Java',
            'city' => 'Maracaibo',
            'Address' => 'Irama'
          ],
          [
            'name' => 'NetPlay BASIC',
            'city' => 'Maracaibo',
            'Address' => 'San Jacinto'
          ],
          [
            'name' => 'NetPlay Java',
            'city' => 'Maracaibo',
            'Address' => 'La Estrella'
          ],
          [
            'name' => 'NetPlay Ruby',
            'city' => 'Valencia',
            'Address' => 'Centro'
          ],
          [
            'name' => 'NetPlay Java',
            'city' => 'Valencia',
            'Address' => 'Casco Historico'
          ],
          [
            'name' => 'NetPlay BASIC',
            'city' => 'Valencia',
            'Address' => 'Sambil'
          ],
          [
            'name' => 'NetPlay BASIC',
            'city' => 'Valencia',
            'Address' => 'Barrio Motocross'
          ]
        ];
        App\Stablishment::hydrate($stablishments)->each(function($stablishment) {
            $stablishment->exists = false;
            $stablishment->timestamps = false;
            $stablishment->save();
        });
        App\Stablishment::get()->each(function($stablishment){
            $names = explode(' ', $stablishment->name);
            $name = $names[1];
            if($name == "Ruby")
            {
              $commodities =
              $stablishment->commodities()->attach([
                1 =>['slots' => 18],
                2 =>['slots' => 30],
                3 =>['slots' => 24],
                4 =>['slots' => 1],
                5 =>['slots' => 1]
                ]);
            }
            else if ($name == "Java")
            {
              $stablishment->commodities()->attach([
                6 =>['slots' => 20],
                2 =>['slots' => 11],
                3 =>['slots' => 16]
                ]);
            }
            else
            {
              $stablishment->commodities()->attach([
                7 =>['slots' => 13],
                8 =>['slots' => 12]
                ]);
            }
        });
    }
}
