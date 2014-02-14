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

        // FK for machuga/authority-l4

        Schema::table(
            'permissions',
            function (Blueprint $table) {
                $table->dropColumn('user_id');
            }
        );

        Schema::table(
            'permissions',
            function (Blueprint $table) {
                $table->integer('user_id')->nullable()->unsigned()->after('id');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
            }
        );

        Schema::table(
            'role_user',
            function (Blueprint $table) {
                $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
                $table->foreign('role_id')->references('id')->on('roles')->onDelete('CASCADE');
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
            'permissions',
            function (Blueprint $table) {
                $table->dropForeign('permissions_user_id_foreign');
            }
        );
        Schema::table(
            'role_user',
            function (Blueprint $table) {
                $table->dropForeign('role_user_user_id_foreign');
                $table->dropForeign('role_user_role_id_foreign');
            }
        );
        Schema::drop('users');
    }

}
