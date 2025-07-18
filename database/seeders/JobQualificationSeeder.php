<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class JobQualificationSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	*/
	public function run() {

		\DB::table('interest_categories')->insert([
         [
             'name' => 'Collectors & enthusiasts',
             'status'=>1,
             'slug'=>'collectors_enthusiasts',
         ],
         [
             'name' => 'General',
             'status' => 1,
             'slug'=>'general',
         ],
          [
             'name' => 'Arts/creativity',
             'status' => 1,
             'slug'=>'arts_creativity',
         ],
          [
             'name' => 'Activities',
             'status' => 1,
             'slug'=>'activities',
         ],
          [
             'name' => 'Games / Sports',
             'status' => 1,
             'slug' =>'games_sports',
         ],
          [
             'name' => 'On the water',
             'status' => 1,
             'slug'=>'on_the_water',
         ],
           [
             'name' => 'On the air',
             'status' => 1,
             'slug'=>'on_the_air',
         ],
        ]);

        \DB::table('interests')->insert([
         [
             'interest_category_id'=>1,
             'name' => 'Supercars',
             'image' => 'null',
             'slug' =>'supercars',
         ],
         [
             'interest_category_id'=>1,
             'name' => 'Classic cars',
             'image' => 'null',
             'slug' =>'classic_cars'
         ],
         [
             'interest_category_id'=>1,
             'name' => 'Watches',
             'image' => 'null',
             'slug' =>'watches',
         ],
         [
             'interest_category_id'=>1,
             'name' => 'Wine',
             'image' => 'null',
             'slug' =>'wine',
         ],
         [
             'interest_category_id'=>2,
             'name' => 'Pet owner',
             'image' => 'null',
             'slug' =>'pet_owner',
         ],
         [
             'interest_category_id'=>2,
             'name' => 'Tech',
             'image' => 'null',
             'slug' =>'tech',
         ],
         [
             'interest_category_id'=>3,
             'name' => 'Painting',
             'image' => 'null',
             'slug' =>'painting',
         ],
         [
             'interest_category_id'=>3,
             'name' => 'Drawing',
             'image' => 'null',
             'slug' =>'drawing',
         ],
         [
             'interest_category_id'=>3,
             'name' => 'Acting',
             'image' => 'null',
             'slug' =>'acting',
         ],
         [
             'interest_category_id'=>3,
             'name' => 'Singing',
             'image' => 'null',
             'slug' =>'singing',
         ],
         [
             'interest_category_id'=>3,
             'name' => 'Dancing',
             'image' => 'null',
             'slug' =>'dancing',
         ],
         [
             'interest_category_id'=>3,
             'name' => 'Theater',
             'image' => 'null',
             'slug' =>'theater',
         ],
         [
             'interest_category_id'=>3,
             'name' => 'Cooking',
             'image' => 'null',
             'slug' =>'cooking',
         ],
         [
             'interest_category_id'=>3,
             'name' => 'Photography',
             'image' => 'null',
             'slug' =>'photography',
         ],
         [
             'interest_category_id'=>3,
             'name' => 'Swing',
             'image' => 'null',
             'slug' =>'swing',
         ],
           [
             'interest_category_id'=>3,
             'name' => 'Gardening',
             'image' => 'null',
             'slug' =>'gardening',
         ],
         [
             'interest_category_id'=>3,
             'name' => 'Fashion',
             'image' => 'null',
             'slug' =>'fashion',
         ],
            [
             'interest_category_id'=>4,
             'name' => 'Hunting',
             'image' => 'null',
             'slug' =>'hunting',
         ],
         [
             'interest_category_id'=>4,
             'name' => 'Yoga',
             'image' => 'null',
             'slug' =>'yoga',
         ],
           [
             'interest_category_id'=>4,
             'name' => 'Running',
             'image' => 'null',
             'slug' =>'running',
         ],
         [
             'interest_category_id'=>4,
             'name' => 'Roller scating',
             'image' => 'null',
             'slug' =>'roller_scating',
         ],
           [
             'interest_category_id'=>4,
             'name' => 'Motorcycling',
             'image' => 'null',
             'slug' =>'motercycling',
         ],
         [
             'interest_category_id'=>4,
             'name' => 'Biking',
             'image' => 'null',
             'slug' =>'biking',
         ],
              [
             'interest_category_id'=>4,
             'name' => 'Hiking',
             'image' => 'null',
             'slug' =>'hiking',
         ],
           [
             'interest_category_id'=>4,
             'name' => 'Climbing',
             'image' => 'null',
             'slug' =>'climbing',
         ],
         [
             'interest_category_id'=>4,
             'name' => 'Camping',
             'image' => 'null',
             'slug' =>'camping',
         ],
             [
             'interest_category_id'=>4,
             'name' => 'Walking around',
             'image' => 'null',
             'slug' =>'walking_around',
         ],
         [
             'interest_category_id'=>4,
             'name' => 'Skiing',
             'image' => 'null',
             'slug' =>'skiing',
         ],
             [
             'interest_category_id'=>4,
             'name' => 'Snowboarding',
             'image' => 'null',
             'slug' =>'snow_boarding',
         ],
         [
             'interest_category_id'=>4,
             'name' => 'Icescating',
             'image' => 'null',
             'slug' =>'ice_scating',
         ],
             [
             'interest_category_id'=>4,
             'name' => 'Equitation',
             'image' => 'null',
             'slug' =>'equitation',
         ],
         [
             'interest_category_id'=>4,
             'name' => 'Horseback riding',
             'image' => 'null',
             'slug' =>'horseback_riding',
         ],
           [
             'interest_category_id'=>4,
             'name' => 'Workout & Fitness',
             'image' => 'null',
             'slug' =>'workout_fitness',
         ],
             [
             'interest_category_id'=>4,
             'name' => 'Motor racing',
             'image' => 'null',
             'slug' =>'motor_racing',
         ],
         [
             'interest_category_id'=>5,
             'name' => 'Board Games',
             'image' => 'null',
             'slug' =>'board_games',
         ],
             [
             'interest_category_id'=>5,
             'name' => 'Video games',
             'image' => 'null',
             'slug' =>'video_games',
         ],
         [
             'interest_category_id'=>5,
             'name' => 'Chess',
             'image' => 'null',
             'slug' =>'chess',
         ],
              [
             'interest_category_id'=>5,
             'name' => 'Poker',
             'image' => 'null',
             'slug' =>'poker',
         ],
         [
             'interest_category_id'=>5,
             'name' => 'Gambling',
             'image' => 'null',
             'slug' =>'gambling',
         ],
             [
             'interest_category_id'=>5,
             'name' => 'Golf',
             'image' => 'null',
             'slug' =>'golf',
         ],
         [
             'interest_category_id'=>5,
             'name' => 'Tenis',
             'image' => 'null',
             'slug' =>'tenis',
         ],
         [
             'interest_category_id'=>5,
             'name' => 'Cricket',
             'image' => 'null',
             'slug' =>'cricket',
         ],
             [
             'interest_category_id'=>5,
             'name' => 'Team sports',
             'image' => 'null',
             'slug' =>'team_sports',
         ],
         [
             'interest_category_id'=>5,
             'name' => 'Watching sports',
             'image' => 'null',
             'slug' =>'watching_sports',
         ],
           [
             'interest_category_id'=>6,
             'name' => 'Scuba diving',
             'image' => 'null',
             'slug' =>'scuba_diving',
         ],
             [
             'interest_category_id'=>6,
             'name' => 'Swimming',
             'image' => 'null',
             'slug' =>'swimming',
         ],
         [
             'interest_category_id'=>6,
             'name' => 'Surfing',
             'image' => 'null',
             'slug' =>'surfing',
         ],
         [
             'interest_category_id'=>6,
             'name' => 'Kitesurfing',
             'image' => 'null',
             'slug' =>'kites_surfing',
         ],
             [
             'interest_category_id'=>6,
             'name' => 'Windsurfing',
             'image' => 'null',
             'slug' =>'wind_surfing',
         ],
         [
             'interest_category_id'=>6,
             'name' => 'Fishing',
             'image' => 'null',
             'slug' =>'fishing',
         ],
          [
             'interest_category_id'=>6,
             'name' => 'Boating',
             'image' => 'null',
             'slug' =>'boating',
         ],
               [
             'interest_category_id'=>7,
             'name' => 'Skydiving',
             'image' => 'null',
             'slug' =>'sky_diving',
         ],
             [
             'interest_category_id'=>7,
             'name' => 'Flyingairplanes',
             'image' => 'null',
             'slug' =>'flying_airplanes',
         ],
         [
             'interest_category_id'=>7,
             'name' => 'RC planes',
             'image' => 'null',
             'slug' =>'rc_planes',
         ],
         [
             'interest_category_id'=>7,
             'name' => 'Hot air ballooning',
             'image' => 'null',
             'slug' =>'hot_air_ballooning',
         ],
        ]);
	}
}
