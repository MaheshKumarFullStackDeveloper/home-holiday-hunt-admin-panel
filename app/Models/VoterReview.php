<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoterReview extends Model
{
    use HasFactory;

    public function user(){
        return  $this->belongsTo(HomeownerInformation::class ,'reported_to','id');
    }
    public function voter(){
        return  $this->belongsTo(Voter::class ,'reported_by','id');
    }
    public function voter_images(){
        return  $this->hasMany(ReviewImage::class ,'user_review_id','id');
    }
    public function reported_by_user(){
        return  $this->hasMany(User::class ,'id','reported_by');
    }

    public function reported_to_user(){
        return  $this->hasMany(HomeownerInformation::class ,'id','reported_to');
    }
}
 