<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */ 
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => '$2y$10$vYl6hnokXidt/sLxgkoK/ObyAWIWJ1MZi4eyutWfcXicl4AxaOZoe',
            'profile_picture'=>"https://source.unsplash.com/random",
            'is_email_verified'=>1,
            'phone_number'=>$this->faker->phoneNumber,
            'country_code'=>"91",
            'ip_address'=>"192.168.1.81",
            'remember_token' => Str::random(10),
        ];
    }
}
