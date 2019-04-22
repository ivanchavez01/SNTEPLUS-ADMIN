<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Benefit extends Model
{
    public $fillable = [
        "description",
        "short_description",
        "municipality_id",
        "service_type_id",
        "business_id",
    ];

    public function business() {
        return $this->hasOne("App\Business", 'id', 'business_id')->withDefault();
    }

    public function municipality() {
        return $this->hasOne("App\Municipality", 'id', 'municipality_id')->withDefault();
    }

    public function serviceType() {
        return $this->hasOne("App\ServiceType", 'id', 'service_type_id')->withDefault();
    }
}
