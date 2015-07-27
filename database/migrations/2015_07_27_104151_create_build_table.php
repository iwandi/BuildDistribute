<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuildTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('build', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            //$table->foreign('projectId')->references('id')->on('project')->onDelete('cascade');
            $table->integer('projectId');
            $table->string('installUrl');
            $table->string('version');
            $table->string('platform');
            $table->string('revision');
            $table->string('androidBundleVersionCode');
            $table->string('iPhoneBundleIdentifier');
            $table->string('iPhoneBundleVersion');
            $table->string('iPhoneTitle');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('build');
    }
}
