<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Group;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ClassificationSeeder extends Seeder
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
        $attribute = ['Penting', 'Biasa', 'Rahasia'];
        $group_id = Group::all()->pluck('id')->toArray();


        for ($i = 1; $i <= 30; $i++) {
            DB::table('classifications')->insert([
                'class' => $faker->countryCode,
                'sub_class' => $faker->countryCode,
                'group_id' => $faker->randomElement($group_id)
            ]);
        } //
    }
}
