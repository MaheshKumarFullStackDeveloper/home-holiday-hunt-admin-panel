<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeownerInformationPics extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','image'];

    /* public function user(){
        return  $this->belongsTo(User::class);
    } */

    public function getImageAttribute($value)
    {
        return env("APP_URL").'home_images/'. $value;
    }
}
