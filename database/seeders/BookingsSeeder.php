<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class BookingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 0; $i < 11; $i++){
            $userId = DB::table('users')->pluck('id')->random();
            $apartmentId = DB::table('apartment')->pluck('id')->random();
    
            DB::table('bookings')->insert([
                'start_date' => Carbon::now()->addDays(rand(1, 5)),
                'end_date' => Carbon::now()->addDays(rand(6, 10)),
                'total' => rand(100, 500) + 0.99,
                'user_id' => $userId,
                'apartment_id' => $apartmentId,
            ]);
        }
        
    }
}
