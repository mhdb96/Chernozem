<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Faker\Factory as Faker;

use App\User;
use App\Models\Customer;
use App\Models\Project;

class UserCustomerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
    	foreach (range(1,62) as $index) {
            $user = new User;
            $user->username = $faker->userName;
            $user->password = bcrypt('secret');
            $user->role_id = 2;
            $user->save();
            
            $customer = new Customer;
            $customer->first_name = $faker->name;
            $customer->last_name = $faker->lastName;
            $customer->user_id = $user->id;
            $customer->created_at = $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now');
            $customer->save();
            
            // project store
            $project = new Project;
            $project->name = $faker->name;
            $project->budget =  30347.00;
            $project->packet_id = 9;  
            $project->customer_id = $customer->id;  
            $project->owns_area = 1;
            $project->area_count = 3; 
            $project->created_at = $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now');
            $project->save();
            
            // project_area store
            $project->areas()->attach(4, ['name' => $faker->sentence(2, true)]);
            $project->areas()->attach(4, ['name' => $faker->sentence(2, true)]);
            $project->areas()->attach(4, ['name' => $faker->sentence(2, true)]);

            // project_area_kit store
            foreach ($project->projectArea as $projectArea) {
                $projectAreaKitName = $projectArea->name.'_Sera Kiti';
                $projectArea->kits()->attach(7, ['name' => $projectAreaKitName]);                
            }
	    }
    }
}
