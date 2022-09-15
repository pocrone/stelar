<?php

namespace Database\Seeders;


use App\Models\User;
use App\Models\Group;
use App\Models\Classroom;
use Faker\Factory as Faker;
use App\Models\Classification;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class InboxMailSeeder extends Seeder
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
        $classification = Classification::all()->pluck('id')->toArray();
        $classroom_id = Classroom::all()->pluck('id')->toArray();
        $group_id = Group::all()->pluck('id')->toArray();

        $attribute = ['Penting', 'Biasa', 'Rahasia'];

        for ($i = 1; $i <= 30; $i++) {
            DB::table('inbox_mails')->insert([
                'mail_number' => $faker->creditCardNumber('Visa', true),
                'date' => $faker->date,
                'time' => $faker->time,
                'sender' => $faker->company,
                'mail_attribute' => $faker->randomElement($attribute),
                'mail_about' => $faker->word(5, 'true'),
                'mail_summary' => $faker->paragraph,
                'status' => $faker->numberBetween('0', '3'),
                'mail_location' => $faker->countryCode,
                'classification_id' => $faker->randomElement($classification),
                'classroom_id' => $faker->randomElement($classroom_id),
                'file' => 'default.png',
                'active_year' => '2022',
                'inactive_year' => '2033',
                'group_id' => $faker->randomElement($group_id),
                'retention_status' => $faker->numberBetween('0', '3'),

            ]);
        }
    }
}
