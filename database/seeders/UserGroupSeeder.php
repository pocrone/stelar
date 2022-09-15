<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\User;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        $user_id = User::all()->pluck('id')->toArray();
        $group_id = Group::all()->pluck('id')->toArray();

        for ($i = 1; $i <= 10; $i++) {
            DB::table('user_groups')->insert([


                'user_id' => $faker->unique()->randomElement($user_id),
                'group_id' => $faker->randomElement($group_id)
            ]);
        }
    }
}
