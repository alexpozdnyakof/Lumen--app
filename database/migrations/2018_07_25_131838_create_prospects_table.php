<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProspectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */ 
    public function up()    
    {
        Schema::create('prospects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('company');
            $table->string('industry');
            $table->string('budget');
            $table->string('ceo');
            $table->string('location');
            $table->string('latest_activity_published');
            $table->int('manager_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prospects');
    }
}
