<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Seller>
 */
class SellerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'shop_name' => $this->faker->company,
            'address' => $this->faker->address,
            'cover_image' => $this->faker->imageUrl(640, 480, 'shops', true, 'cover'),
            'profile_image' => $this->faker->imageUrl(640, 480, 'shops', true, 'profile'),
            'manager_name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'phone' => $this->faker->phoneNumber,
            'country' => $this->faker->country,
            'postal_code' => $this->faker->postcode,
            'status' => $this->faker->randomElement(['active', 'disabled']),
        ];
    }
}
