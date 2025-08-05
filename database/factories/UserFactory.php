<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\City;
use App\Models\Country;
use Illuminate\Support\Facades\Hash;

use App\Models\Government;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $country = Country::inRandomOrder()->first();
        if (!$country) {
            throw new \Exception("No countries found! Please seed the countries table.");
        }

        $governorate = $country->govrnorates()->inRandomOrder()->first();
        if (!$governorate) {
            throw new \Exception("No governorates found for country {$country->id}! Please seed the governorates table.");
        }

        $city = $governorate->cities()->inRandomOrder()->first();
        if (!$city) {
            throw new \Exception("No cities found for governorate {$governorate->id}! Please seed the cities table.");
        }
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'is_active' => 1,
            'phone'=>fake()->phoneNumber,
            'country_id' => $country->id,
            'government_id' => $governorate->id,
            'city_id' => $city->id,
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return $this
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
