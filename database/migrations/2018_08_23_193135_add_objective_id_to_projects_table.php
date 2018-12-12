<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddObjectiveIdToProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn ('projects', 'objective_id')) {
            Schema::table('projects', function (Blueprint $table) {
                $table->integer('objective_id')->unsigned()->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn ('projects', 'objective_id')) {
            Schema::table('projects', function (Blueprint $table) {
                $table->dropColumn('objective_id');
            });
        }
    }
}
