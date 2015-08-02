<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSimpleNotes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('simple-notes', function(Blueprint $table) {
    		$table->increments('id');
    		$table->integer('user_id')->unsigned()->default(0);				                // reference to our users table
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // allows automatic deletions
    		$table->string('title')->default('');
    		$table->mediumText('content')->default('');
    		$table->timestamps(); 
    	});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('simple-notes');
    }
}
