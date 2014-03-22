<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContentsEntity extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'content_types',
            function (Blueprint $table) {
                $table->increments('id');
                $table->string('name')->unique();
                $table->timestamps();
            }
        );

        Schema::create(
            'contents',
            function (Blueprint $table) {
                $table->increments('id');
                $table->integer('type_id')->unsigned();
                $table->string('path', 255)->nullable();
                $table->integer('parent_id')->unsigned()->nullable();
                $table->integer('user_id')->unsigned()->nullable();
                $table->integer('level')->default(0);
                $table->integer('rating')->default(0);
                $table->integer('visits')->default(0);
                $table->integer('weight')->default(0);
                $table->boolean('is_on_home');
                $table->boolean('is_comment_allowed');
                $table->boolean('is_promoted');
                $table->boolean('is_sticky');
                $table->boolean('is_active');
                $table->binary('options');
                $table->timestamp('published_at');
                $table->timestamps();
                $table->softDeletes();
                $table->index(array('path', 'parent_id', 'level', 'is_active'));
                $table->foreign('type_id')->references('id')->on('content_types')->onDelete('CASCADE');
                $table->foreign('parent_id')->references('id')->on('contents')->onDelete('CASCADE');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('SET NULL');
            }
        );

        Schema::create(
            'content_translations',
            function (Blueprint $table) {
                $table->increments('id');
                $table->integer('content_id')->unsigned();
                $table->string('lang_code', 2);
                $table->string('url');
                $table->string('title');
                $table->string('body');
                $table->string('seo_title');
                $table->string('seo_description');
                $table->boolean('is_current');
                $table->timestamps();
                $table->foreign('content_id')->references('id')->on('contents')->onDelete('CASCADE');
                $table->foreign('lang_code')->references('code')->on('langs')->onDelete('CASCADE');
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
        Schema::drop('content_translations');
        Schema::drop('contents');
        Schema::drop('content_types');
    }

}
