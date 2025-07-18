<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserImage extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','image_name','image_updated_from'];

      public function user(){
      return  $this->belongsTo(User::class);
    }

    public function getImageAttribute($value)
      {
          return env("APP_URL").'home_images/'. $value;
      }
}
