<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    public $table = "business";
    public $fillable = [
        "name",
        "address",
        "phone",
        "logo",
        "lat",
        "long",
        "municipality_id",
    ];

    public function municipality() {
        return $this->hasOne("App\Municipality", 'id', 'municipality_id');
    }
}
