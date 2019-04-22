<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FCM_token extends Model
{
    public $table = "fcm_tokens";
    public $fillable = ['uuid', 'token'];
}
