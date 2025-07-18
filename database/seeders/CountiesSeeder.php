<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CountiesSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	*/
	public function run() {

		\DB::table('countries')->truncate();

		$counties = [
			[
				'country_name' => 'United States',
			],
			[
				'country_name' => 'Mexico',
			],
			[
				'country_name' => 'Canada',
			],
			[
				'country_name' => 'Brazil',
			],
			[
				'country_name' => 'Argentina',
			],
			[
				'country_name' => 'France',
			],
			[
				'country_name' => 'Italy',
			],
			[
				'country_name' => 'Spain',
			],
			[
				'country_name' => 'Germany',
			],
			[
				'country_name' => 'United Kingdom',
			],
			[
				'country_name' => 'Russia',
			],
			[
				'country_name' => 'India',
			],
		];
		
		\DB::table('countries')->insert($counties);
	}
}
