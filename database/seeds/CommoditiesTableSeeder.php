<?php

use Illuminate\Database\Seeder;

class CommoditiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $commodities = [
          [
            'name' => 'Coffee Play',
          ],
          [
            'name' => 'Net Hall',
          ],
          [
            'name' => 'Play Hall',
          ],
          [
            'name' => 'Play Movies',
          ],
          [
            'name' => 'Ruby Hall',
          ],
          [
            'name' => 'Java Cafe',
          ],
          [
            'name' => 'BASIC NetHall',
          ],
          [
            'name' => 'BASIC Cafe',
          ],
        ];
        App\Commodity::hydrate($commodities)->each(function($commodity) {
            $commodity->exists = false;
            $commodity->timestamps = false;
            $commodity->save();
        });
    }
}
