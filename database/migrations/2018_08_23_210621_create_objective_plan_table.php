<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObjectivePlanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('objective_plan', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('objective_id');
            $table->integer('plan_id');
            $table->unique(['objective_id', 'plan_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('objective_plan');
    }
}
