<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DbDesign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("municipalities", function($table) {
            $table->increments("id");
            $table->string("name");
            $table->timestamps();
        });

        Schema::create("business", function($table) {
            $table->increments("id");
            $table->string("name");
            $table->string("address");
            $table->char("phone", 10);
            $table->string("logo");
            $table->integer("municipality_id")->unsigned();
            $table->timestamps();
        });

        Schema::table("business", function($table) {
            $table->foreign('municipality_id')->references('id')->on('municipalities');
        });

        Schema::create("service_types", function($table) {
            $table->increments("id");
            $table->string("name");
            $table->timestamps();
        });

        Schema::create("benefits", function($table) {
            $table->increments("id");
            $table->integer("business_id")->unsigned();
            $table->integer("municipality_id")->unsigned();
            $table->integer("service_type_id")->unsigned();
            $table->text("description");
            $table->text("short_description");
            $table->timestamps();
        });

        Schema::table("benefits", function($table) {
            $table->foreign('business_id')->references('id')->on('business');
            $table->foreign('municipality_id')->references('id')->on('municipalities');
            $table->foreign('service_type_id')->references('id')->on('service_types');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop("benefits");
        Schema::drop("business");
        Schema::drop("municipalities");
        Schema::drop("service_types");
    }
}
