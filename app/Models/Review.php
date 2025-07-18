<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    


    use HasFactory;
   //mk
    public function order(){
        return $this->belongsTo(Order::class,'order_id');
    }

  //Order ->user_id User id

  public function user(){
    return $this->belongsTo(User::class);
}




 



}
