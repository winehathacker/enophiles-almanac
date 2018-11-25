<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('country_id')->nullable();
            $table->auditable();
            $table->timestamps();

            $table->foreign('country_id')
                ->references('id')
                ->on('regions');
        });

        Schema::create('region_relationships', function (Blueprint $table) {
            $table->unsignedInteger('parent_id');
            $table->unsignedInteger('child_id');
            $table->auditable();
            $table->timestamps();

            $table->foreign('parent_id')
                ->references('id')
                ->on('regions');

            $table->foreign('child_id')
                ->references('id')
                ->on('regions');

            $table->unique(['parent_id', 'child_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('region_relationships');
        Schema::dropIfExists('regions');
    }
}
