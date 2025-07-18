<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdminNotification extends Model
{
    use HasFactory, SoftDeletes;

    protected $with = ["notified_users"];

    public function notified_users(){
        return $this->hasMany('App\Models\AdminNotificationUser', 'admin_notifications_id', 'id');
    }
}
