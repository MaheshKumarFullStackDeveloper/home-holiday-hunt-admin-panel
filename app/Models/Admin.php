<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $guard = 'admin';


    protected $fillable = [
        'first_name','last_name','name', 'email','role_id','phone_number','country_code', 'password','phone_no','fcm_token'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

	/**
	 * Get the admins for the role.
	*/
	public function role() {
		return $this->belongsTo(Role::class);
	}
}
