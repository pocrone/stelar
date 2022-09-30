<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Classroom;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        $classroom_id = Classroom::all()->pluck('id')->toArray();

        for ($i = 1; $i <= 30; $i++) {
            DB::table('users')->insert([

                'name' => $faker->name,
                'email' => $faker->unique()->name . '@test.com',
                'password' => bcrypt('password'),
                'role' => '2',
                'avatar' => 'default.jpg',
                'classroom_id' => $faker->randomElement($classroom_id)
            ]);
        }
    }
}
