<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVarietyClone extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('varieties', function (Blueprint $table) {
            $table->unsignedInteger('clone_source_id')->nullable();

            $table->foreign('clone_source_id')
                ->references('id')
                ->on('varieties');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('varieties', function (Blueprint $table) {
            $table->dropColumn('clone_source_id');
        });
    }
}
