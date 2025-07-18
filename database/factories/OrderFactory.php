<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Order;
use App\Models\UserAddress;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $items = array(0, 1);
        $is_assigned = $items[array_rand($items)];
        return [
            'user_id' => User::factory()->create()->id,
            'session_id' => 'RM-'.strtoupper(uniqid()),
            'token' => 'RM-'.strtoupper(uniqid()),
            'status' => 1,
            'sub_total' => 100,
            'item_discount' => 10,
            'tax' => 10,
            'shipping' => 10,
            'overall_price' => 120,
            'grand_total' => 100,
            'is_assigned' => $is_assigned==0 ? 0:1,
            'delivery_agent_id' => $is_assigned==0 ? null:1,
            'user_address_id' => UserAddress::factory()->create()->id,
            'content'=>'N/A',
            'created_at'=>now(),
            'updated_at'=>now(),
        ];
    }
}
