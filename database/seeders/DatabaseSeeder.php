<?php

namespace Database\Seeders;

use App\Models\Apartment;
use App\Models\User;
use App\Models\Booking;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    // database/seeders/DatabaseSeeder.php
    public function run(): void
    {
        $users = User::factory(10)->create();


        $apartments = Apartment::factory(5)
            ->recycle($users)
            ->create();

        Booking::factory(20)
            ->recycle($users)
            ->recycle($apartments)
            ->create();
    }
}
