<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class ApartmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userId = DB::table('users')->pluck('id')->random();

        foreach (range(1, 10) as $index) {
            DB::table('apartments')->insert([
                'title' => 'Beautiful ' . Str::random(5) . ' Home',
                'description' => 'This is a random description for property number ' . $index,
                'country' => Str::random(10),
                'rooms' => rand(1, 5),
                'price_per_night' => rand(50, 500) + 0.99,
                'user_id' => $userId,
            ]);
        }
    }
}
