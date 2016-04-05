<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuildsTable extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('builds', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('project_id')->unsigned();
			$table->string('bundleIdentifier');
			$table->string('installFolder');
			$table->string('installFileName');
			$table->string('version');
            $table->string('buildNumber');
            $table->string('platform');
            $table->string('revision');
            $table->string('tag')->nullable();
            $table->string('androidBundleVersionCode')->nullable();
            $table->string('iphoneBundleVersion')->nullable();
            $table->string('iphoneTitle')->nullable();
			$table->timestamps();
			
			$table->unique(['project_id', 'buildNumber']);

            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
		});
    }

    /**
    * Reverse the migrations.
    *
    * @return void
    */
    public function down()
    {
        Schema::drop('builds');
    }
}
