<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Hash;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\OrderItem;
use App\Models\Order;
use App\Models\Product;

class UsersSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	*/
	public function run() {
		   $deleteorderitem = OrderItem::truncate();
		   $deleteorder = Order::truncate();
		   $deleteuseraddress = UserAddress::truncate();
		
		   $user = User::factory()->hasuserAddress(2)->hasorders(2)->count(10)->create();
		   $orders = Order::get();
		   foreach($orders as $key=>$data){
		   		$product = Product::whereHas('ProductVariant')->with('ProductVariant')->first();
		   		
		   		$orderItems = new OrderItem;
		   		$orderItems->product_id = $product->id;
		   		if($product->ProductVariant->unit_250g==='on'){
		   		$orderItems->product_variant = '250g';	
		   		}
		   		if($product->ProductVariant->unit_500g==='on'){
		   		$orderItems->product_variant = '500g';	
		   		}
		   		if($product->ProductVariant->unit_1kg==='on'){
		   		$orderItems->product_variant = '1kg';	
		   		}
		   		$orderItems->order_id = $data->id;
		   		$orderItems->price = 10;
		   		$orderItems->discount = 2;
		   		$orderItems->quantity = 2;
		   		$orderItems->content = "Not Available";
		   		$orderItems->created_at = now();
		   		$orderItems->updated_at = now();
		   		$orderItems->save();
		   }
		
	}
}