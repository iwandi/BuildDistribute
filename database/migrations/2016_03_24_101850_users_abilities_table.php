<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UsersAbilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usersAbilities', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('ability_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->unique(['user_id', 'ability_id']);
			$table->timestamps();
			
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('ability_id')->references('id')->on('abilities')->onDelete('cascade');
		});
	}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('usersAbilities');
    }
}
