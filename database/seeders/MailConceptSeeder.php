<?php

namespace Database\Seeders;


use Faker\Factory as Faker;
use App\Models\User;
use App\Models\Classroom;
use App\Models\Group;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MailConceptSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        $users = User::all()->pluck('id')->toArray();
        $classroom_id = Classroom::all()->pluck('id')->toArray();
        $group_id = Group::all()->pluck('id')->toArray();

        for ($i = 1; $i <= 30; $i++) {
            DB::table('mail_concepts')->insert([
                'user_id' => $faker->randomElement($users),
                'mail_concept' => $faker->text,
                'date' => $faker->date,
                'status' => $faker->numberBetween('0', '1'),
                'classroom_id' => $faker->randomElement($classroom_id),
                'group_id' => $faker->randomElement($group_id)
            ]);
        }
    }
}
