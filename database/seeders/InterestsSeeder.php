<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class InterestsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('interests')->truncate();
        $interests = [
            [
                'interest_category_id' => '1',  
                'name' => 'Supercars',
                'slug' => 'supercars',
                'image' => 'supercars.svg',
            ],
            [
                'interest_category_id' => '1',  
                'name' => 'Classic cars',
                'slug' => 'classic_cars',
                'image' => 'classic_cars.svg',
            ],
            [
                'interest_category_id' => '1',  
                'name' => 'Watches',
                'slug' => 'watches',
                'image' => 'watches.svg',
            ],
            [
                'interest_category_id' => '1',  
                'name' => 'Cigars',
                'slug' => 'cigars',
                'image' => 'cigars.svg',
            ],
            [
                'interest_category_id' => '1',  
                'name' => 'Wine',
                'slug' => 'wine',
                'image' => 'wine.svg',
            ],
            [
                'interest_category_id' => '1',  
                'name' => 'Blockchain',
                'slug' => 'blockchain',
                'image' => 'blockchain.svg',
            ],
            [
                'interest_category_id' => '2',  
                'name' => 'Photography',
                'slug' => 'photography',
                'image' => 'photography.svg',
            ],
            [
                'interest_category_id' => '2',  
                'name' => 'Fashion',
                'slug' => 'fashion',
                'image' => 'fashion.svg',
            ],
            [
                'interest_category_id' => '2',  
                'name' => 'Painting',
                'slug' => 'painting',
                'image' => 'painting.svg',
            ],
            [
                'interest_category_id' => '2',  
                'name' => 'Drawing',
                'slug' => 'drawing',
                'image' => 'drawing.svg',
            ],
            [
                'interest_category_id' => '2',  
                'name' => 'Acting',
                'slug' => 'acting',
                'image' => 'acting.svg',
            ],
            [
                'interest_category_id' => '2',  
                'name' => 'Singing',
                'slug' => 'singing',
                'image' => 'singing.svg',
            ],
            [
                'interest_category_id' => '2',  
                'name' => 'Dancing',
                'slug' => 'dancing',
                'image' => 'dancing.svg',
            ],
            [
                'interest_category_id' => '3',  
                'name' => 'Workout & Fitness',
                'slug' => 'workout_fitness',
                'image' => 'workout_fitness.svg',
            ],
            [
                'interest_category_id' => '3',  
                'name' => 'Yoga & Mediation',
                'slug' => 'yoga_mediation',
                'image' => 'yoga_mediation.svg',
            ],
            [
                'interest_category_id' => '3',  
                'name' => 'Walking around',
                'slug' => 'walking_around',
                'image' => 'walking_around.svg',
            ],
            [
                'interest_category_id' => '3',  
                'name' => 'Running',
                'slug' => 'running',
                'image' => 'running.svg',
            ],
            [
                'interest_category_id' => '3',  
                'name' => 'Hiking',
                'slug' => 'hiking',
                'image' => 'hiking.svg',
            ],
            [
                'interest_category_id' => '3',  
                'name' => 'Climbing',
                'slug' => 'climbing',
                'image' => 'climbing.svg',
            ],
            [
                'interest_category_id' => '3',  
                'name' => 'Camping',
                'slug' => 'camping',
                'image' => 'camping.svg',
            ],
            [
                'interest_category_id' => '3',  
                'name' => 'Hunting',
                'slug' => 'hunting',
                'image' => 'hunting.svg',
            ],
            [
                'interest_category_id' => '3',  
                'name' => 'Biking',
                'slug' => 'biking',
                'image' => 'biking.svg',
            ],
            [
                'interest_category_id' => '3',  
                'name' => 'Motorcycling',
                'slug' => 'motorcycling',
                'image' => 'motorcycling.svg',
            ],
            [
                'interest_category_id' => '3',  
                'name' => 'Motor racing',
                'slug' => 'motor_racing',
                'image' => 'motor_racing.svg',
            ],
            [
                'interest_category_id' => '3',  
                'name' => 'Roller skating',
                'slug' => 'roller_skating',
                'image' => 'roller_skating.svg',
            ],
            [
                'interest_category_id' => '3',  
                'name' => 'Skiing',
                'slug' => 'skiing',
                'image' => 'skiing.svg',
            ],
            [
                'interest_category_id' => '3',  
                'name' => 'Snowboarding',
                'slug' => 'snowboarding',
                'image' => 'snowboarding.svg',
            ],
            [
                'interest_category_id' => '3',  
                'name' => 'Ice skating',
                'slug' => 'ice_skating',
                'image' => 'ice_skating.svg',
            ],
            [
                'interest_category_id' => '3',  
                'name' => 'Equitation',
                'slug' => 'equitation',
                'image' => 'equitation.svg',
            ],
            [
                'interest_category_id' => '3',  
                'name' => 'Horseback riding',
                'slug' => 'horseback_riding',
                'image' => 'horseback_riding.svg',
            ],
            [
                'interest_category_id' => '3',  
                'name' => 'Golf',
                'slug' => 'golf',
                'image' => 'golf.svg',
            ],
            [
                'interest_category_id' => '3',  
                'name' => 'Tennis',
                'slug' => 'tennis',
                'image' => 'tennis.svg',
            ],
            [
                'interest_category_id' => '3',  
                'name' => 'Cricket',
                'slug' => 'cricket',
                'image' => 'cricket.svg',
            ],
            [
                'interest_category_id' => '3',  
                'name' => 'Team sports',
                'slug' => 'team_sports',
                'image' => 'team_sports.svg',
            ],
            [
                'interest_category_id' => '4',  
                'name' => 'Scuba diving',
                'slug' => 'scuba_diving',
                'image' => 'scuba_diving.svg',
            ],
            [
                'interest_category_id' => '4',  
                'name' => 'Swimming',
                'slug' => 'swimming',
                'image' => 'swimming.svg',
            ],
            [
                'interest_category_id' => '4',  
                'name' => 'Surfing',
                'slug' => 'surfing',
                'image' => 'surfing.svg',
            ],
            [
                'interest_category_id' => '4',  
                'name' => 'Kitesurfing',
                'slug' => 'kitesurfing',
                'image' => 'kitesurfing.svg',
            ],
            [
                'interest_category_id' => '4',  
                'name' => 'Windsurfing',
                'slug' => 'windsurfing',
                'image' => 'windsurfing.svg',
            ],
            [
                'interest_category_id' => '4',  
                'name' => 'Fishing',
                'slug' => 'fishing',
                'image' => 'fishing.svg',
            ],
            [
                'interest_category_id' => '4',  
                'name' => 'Boating',
                'slug' => 'boating',
                'image' => 'boating.svg',
            ],
            [
                'interest_category_id' => '5',  
                'name' => 'Skydiving',
                'slug' => 'skydiving',
                'image' => 'skydiving.svg',
            ],
            [
                'interest_category_id' => '5',  
                'name' => 'Flying airplanes',
                'slug' => 'flying_airplanes',
                'image' => 'flying_airplanes.svg',
            ],
            [
                'interest_category_id' => '5',  
                'name' => 'RC planes',
                'slug' => 'rc_planes',
                'image' => 'rc_planes.svg',
            ],
            [
                'interest_category_id' => '5',  
                'name' => 'Hot air ballooning',
                'slug' => 'hot_air_ballooning',
                'image' => 'hot_air_ballooning.svg',
            ],
            [
                'interest_category_id' => '6',  
                'name' => 'Board Games',
                'slug' => 'board_games',
                'image' => 'board_games.svg',
            ],
            [
                'interest_category_id' => '6',  
                'name' => 'Video games',
                'slug' => 'video_games',
                'image' => 'video_games.svg',
            ],
            [
                'interest_category_id' => '6',  
                'name' => 'Chess',
                'slug' => 'chess',
                'image' => 'chess.svg',
            ],
            [
                'interest_category_id' => '6',  
                'name' => 'Poker',
                'slug' => 'poker',
                'image' => 'poker.svg',
            ],
            [
                'interest_category_id' => '6',  
                'name' => 'Gambling',
                'slug' => 'gambling',
                'image' => 'gambling.svg',
            ],
            [
                'interest_category_id' => '7',  
                'name' => 'Coffee',
                'slug' => 'coffee',
                'image' => 'coffee.svg',
            ],
            [
                'interest_category_id' => '7',  
                'name' => 'Drinks',
                'slug' => 'drinks',
                'image' => 'drinks.svg',
            ],
            [
                'interest_category_id' => '7',  
                'name' => ' Food & Restaurants',
                'slug' => 'food_and_restaurants',
                'image' => 'food_and_restaurants.svg',
            ],
           
            [
                'interest_category_id' => '7',  
                'name' => 'Pet owner',
                'slug' => 'pet_owner',
                'image' => 'pet_owner.svg',
            ],
            [
                'interest_category_id' => '7',  
                'name' => 'Watching sports',
                'slug' => 'watching_sports',
                'image' => 'watching_sports.svg',
            ],
            [
                'interest_category_id' => '7',  
                'name' => 'Tech',
                'slug' => 'tech',
                'image' => 'tech.svg',
            ],
            [
                'interest_category_id' => '7',  
                'name' => 'Movies',
                'slug' => 'movies',
                'image' => 'movies.svg',
            ],
            [
                'interest_category_id' => '7',  
                'name' => 'Theater',
                'slug' => 'theater',
                'image' => 'theater.svg',
            ],
            [
                'interest_category_id' => '7',  
                'name' => 'Cooking',
                'slug' => 'cooking',
                'image' => 'cooking.svg',
            ],
            [
                'interest_category_id' => '7',  
                'name' => 'Gardening',
                'slug' => 'gardening',
                'image' => 'gardening.svg',
            ],
            [
                'interest_category_id' => '7',  
                'name' => 'Crochet',
                'slug' => 'crochet',
                'image' => 'crochet.svg',
            ],
            [
                'interest_category_id' => '7',  
                'name' => 'Sewing',
                'slug' => 'sewing',
                'image' => 'sewing.svg',
            ],
        ];
    
        \DB::table('interests')->insert($interests);
    }
}
