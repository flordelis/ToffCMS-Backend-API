<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixPageTableUniqueProblem extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'pages',
            function(Blueprint $table)
            {
                $table->dropUnique('pages_slug_unique');
                $table->unique(array('slug', 'language'));
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(
            'pages',
            function(Blueprint $table)
            {
                $table->dropUnique('pages_slug_language_unique');
                $table->unique('slug');
            }
        );
    }
}
