<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSchoolAndProfToPost extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function ( $table) {
            $table->string('prof_firstname');
        });
        Schema::table('posts', function ( $table) {
            $table->string('prof_lastname');
        });
        Schema::table('posts', function ( $table) {
            $table->string('school');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function ( $table) {
            $table->dropColumn('prof_firstname');
        });
        Schema::table('posts', function ( $table) {
            $table->dropColumn('prof_lastname');
        });
        Schema::table('posts', function ( $table) {
            $table->dropColumn('school');
        });
    }
}
