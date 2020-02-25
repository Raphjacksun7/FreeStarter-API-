<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Faker\Factory as Faker;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $faker = Faker::create();
        for($i=0; $i<=20; $i++):
            DB::table('projects')->insert([
                'user_id'=>$faker->numberBetween(0,10),
                'contributor_id'=>$faker->numberBetween(0,2),
                'title'=>$faker->sentence,
                'category'=>$faker->sentence,
                'current_budget'=>$faker->numberBetween(0,1000000),
                'budget'=>$faker->numberBetween(1000,100000),
                'contributors_number'=>$faker->numberBetween(0,956),
                'duration'=>$faker->numberBetween(30,240),
                'progression'=>$faker->numberBetween(0,100),
                'contact'=>$faker->numberBetween(8,11),
            ]);
            endfor;
    }
}
