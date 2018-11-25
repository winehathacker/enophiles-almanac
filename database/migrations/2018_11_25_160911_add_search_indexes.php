<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSearchIndexes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE varieties ADD searchable tsvector NULL');
        DB::statement('CREATE INDEX varieties_searchable_index ON varieties USING GIN (searchable)');

        DB::statement('ALTER TABLE regions ADD searchable tsvector NULL');
        DB::statement('CREATE INDEX regions_searchable_index ON regions USING GIN (searchable)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('ALTER TABLE varieties DROP COLUMN searchable');
        DB::statement('ALTER TABLE regions DROP COLUMN searchable');
    }
}
