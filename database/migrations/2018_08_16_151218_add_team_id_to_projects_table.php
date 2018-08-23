<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTeamIdToProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasColumn('projects', 'team_id')) {
            Schema::table('projects', function (Blueprint $table) {
                $table->integer('team_id')->unsigned()->nullable();
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
        if (Schema::hasColumn ('projects', 'team_id')) {
            Schema::table('projects', function (Blueprint $table) {
                $table->dropColumn('team_id');
            });
        }
    }
}
