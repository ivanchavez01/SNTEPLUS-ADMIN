<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropForeign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("business", function($table) {
            $table->dropForeign('business_municipality_id_foreign');
        });
        Schema::table("benefits", function($table) {
            $table->dropForeign('benefits_business_id_foreign');
            $table->dropForeign('benefits_service_type_id_foreign');
            // $table->dropForeign('service_type_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
