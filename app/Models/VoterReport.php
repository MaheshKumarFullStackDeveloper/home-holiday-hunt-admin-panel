<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoterReport extends Model
{
    use HasFactory;



    public function reported_to_user(){
        return  $this->belongsTo(User::class ,'reported_to','id');
    }
    public function reported_by_user(){
        return  $this->belongsTo(User::class ,'reported_by','id');
    }

    public function review_id_user(){
        return  $this->belongsTo(VoterReview::class ,'review_id','id');
    }

}
