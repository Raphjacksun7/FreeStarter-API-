<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Faker\Factory as Faker;

class ContributorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
    	foreach (range(1,20) as $index) {
	        DB::table('users')->insert([
                'user_id'=>$faker->numberBetween(1,10),
                'project_id'=>$faker->numberBetween(0,19),
	        ]);
	    }
    }
}
