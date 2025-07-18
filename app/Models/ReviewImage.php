<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewImage extends Model
{
    use HasFactory;


    public function getImagesAttribute($value)
    {
        return 'http://localhost/Nikko-Gabriel-Guyaban-Holiday-Home-Hunt-Admin/public/home_images/'. $value;
    }
}
