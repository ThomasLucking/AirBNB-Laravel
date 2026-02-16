<?php

namespace Database\Factories;
use App\Models\User;
use App\Models\Apartment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{


    public function definition(): array
    {
        return [
            'start_date' => now()->addDays(rand(1, 5)),
            'end_date' => now()->addDays(rand(6, 10)),
            'total' => $this->faker->randomFloat(2, 100, 500),

            'user_id' => User::factory(),
            'apartment_id' => Apartment::factory()

        ];
    }
}
