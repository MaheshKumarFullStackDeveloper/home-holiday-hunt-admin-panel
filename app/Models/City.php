<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'country_id', 'city_name', 'city_image', 'city_status'
    ];


    public function userdestination(){
      return $this->hasMany(UserDestination::class,'dest_id','id');
    }

    public function getCityImageAttribute($value)
    {
        return env('APP_URL').'images/flags/'. $value;
    }

    
}
