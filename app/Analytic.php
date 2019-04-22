<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Analytic extends Model
{
    public $fillable = [
        "uuid",
        "platform",
        "page",
        "category"
    ];
}
