<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Apartment>
 */
class ApartmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'title' => $this->faker->sentence(3) . ' Apartment',
            'description' => $this->faker->paragraph(),
            'country' => $this->faker->country(),
            'rooms' => $this->faker->numberBetween(1, 5),
            'price_per_night' => $this->faker->randomFloat(2, 50, 500),
        ];
    }
}
