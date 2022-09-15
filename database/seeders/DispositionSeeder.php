<?php

namespace Database\Seeders;

use App\Models\InboxMail;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DispositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        $inbox = InboxMail::all()->pluck('id')->toArray();

        for ($i = 1; $i <= 30; $i++) {
            DB::table('dispositions')->insert([
                'date' => $faker->date,
                'sender' => $faker->name,
                'recevier' => $faker->name,
                'instruction' => $faker->text,
                'inbox_mail_id' => $faker->randomElement($inbox),
                'status' => $faker->numberBetween(0, '1'),
            ]);
        }
    }
}
