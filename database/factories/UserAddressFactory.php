<?php

namespace Database\Factories;

use App\Models\UserAddress;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


class UserAddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserAddress::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory()->create()->id,
            'user_name' => $this->faker->name,
            'address_line_1' => $this->faker->address,
            'address_line_2' => $this->faker->address,
            'phone_number' => $this->faker->phoneNumber,
            'country' => $this->faker->country,
            'country_code' => "91",
            'is_active' => 0,
        ];
    }
}
