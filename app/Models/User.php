<?php

namespace App\Models;

use App\Models\Order;
use App\Models\UserAddress;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\Log;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'profile_picture',
        'gender',
        'sexual_orientation',
        'ethinicity',
        'dob',
        'preferred_lang',
        'height',
        'weight',
        'skin_color',
        'body_type',
        'bio',
        'profile_updated_from',
        'password',
        'email_verification_token',
        'email_verified_at',
        'is_email_verified',
        'phone_number',
        'country_code',
        'ip_address',
        'remember_me',  
        'login_with',
        'user_locked',
        'user_locked_at', 
        'wrong_attempt',
        'last_login_at', 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

     

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
    'created_at' => 'datetime:d.m.Y',
];
       // this is the recommended way for declaring event handlers
        public static function boot() {
             parent::boot();

        }


        public function voterreview(){
          return  $this->hasMany(VoterReview::class , 'reported_by' , 'id');
        }
          public function userImages(){
            return  $this->hasMany(UserImage::class);
          }
    
          public function child()
          {
              return $this->belongsTo(User::class,'id', 'nominated_by');
          }

          public function reviews()
          {
            return  $this->hasMany(VoterReview::class , 'reported_to' , 'id');
           }
}