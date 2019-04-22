<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{
    public $table = "municipios";

    public function scopeOnlySonora($query) {
        $query->join("estados_municipios", "municipios.id", "municipios_id")
        ->where("estados_municipios.estados_id", "=", 26)
        ->orderBy("municipio", "ASC");
    }
}
