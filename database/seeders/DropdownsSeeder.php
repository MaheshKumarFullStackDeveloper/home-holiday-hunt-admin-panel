<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DropdownsSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	*/
	public function run() {

		\DB::table('md_dropdowns')->delete();
		$dropdowns = [
			
			['name'=>'School','slug'=>'user_type','values'=>'school'],
			['name'=>'Student','slug'=>'user_type','values'=>'student'],
			['name'=>'Parent','slug'=>'user_type','values'=>'parent'],
			['name'=>'Teaching Professional','slug'=>'user_type','values'=>'teaching_professional'],

		];
		\DB::table('md_dropdowns')->insert($dropdowns);
	}
}
