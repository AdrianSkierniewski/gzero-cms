<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersEntity extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'users',
            function (Blueprint $table) {
                $table->increments('id');
                $table->string('email');
                $table->string('password', 60);
                $table->string('first_name')->nullable();
                $table->string('last_name')->nullable();
                $table->boolean('is_active');
                $table->timestamps();
                $table->softDeletes();
                $table->unique('email');
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
        Schema::drop('users');
    }

}
