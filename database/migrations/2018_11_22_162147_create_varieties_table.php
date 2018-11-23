<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVarietiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('variety_alias_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->auditable();
            $table->timestamps();
        });

        Schema::create('varieties', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->unsignedInteger('alias_group_id')->nullable();
            $table->auditable();
            $table->timestamps();

            $table->foreign('alias_group_id')
                ->references('id')
                ->on('variety_alias_groups')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('varieties');
        Schema::dropIfExists('variety_alias_groups');
    }
}
