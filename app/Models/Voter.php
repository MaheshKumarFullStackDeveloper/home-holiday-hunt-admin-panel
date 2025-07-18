<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Voter extends Model
{
    use HasFactory, SoftDeletes;



     public function voterreview(){
        return  $this->hasMany(VoterReview::class , 'reported_by' , 'id');
    }
    public function reviews(){
        return $this->hasMany(VoterReview::class,'reported_to');
      }
 
    
}
