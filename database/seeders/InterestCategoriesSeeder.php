<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class InterestCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('interest_categories')->truncate();
        $interest_categories = [
            [
                'name' => 'Collectors & Enthusiasts',
                'slug' => 'collectors_enthusiasts',
            ],
            [
                'name' => 'Arts / Creativity',
                'slug' => 'arts_creativity',
            ],
            [
                'name' => 'Sports / Activities',
                'slug' => 'sports_activities',
            ],
            [
                'name' => 'On the water',
                'slug' => 'on_the_water',
            ],
            [
                'name' => 'On the air',
                'slug' => 'on_the_air',
            ],
            [
                'name' => 'Games',
                'slug' => 'games',
            ],
            [
                'name' => 'Other Passions',
                'slug' => 'other_passions',
            ],
        ];
    
        \DB::table('interest_categories')->insert($interest_categories);
    }
}
