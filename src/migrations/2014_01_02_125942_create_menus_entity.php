<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMenusEntity extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'menu_links',
            function (Blueprint $table) {
                $table->increments('id');
                $table->string('path', 255)->nullable();
                $table->integer('content_id')->unsigned()->nullable();
                $table->integer('parent_id')->unsigned()->nullable();
                $table->enum('target', array('_self', '_blank', '_parent', '_top'));
                $table->integer('level')->default(0);
                $table->integer('weight')->default(0);
                $table->boolean('is_active');
                $table->binary('options');
                $table->timestamps();
                $table->softDeletes();
                $table->index(array('path', 'parent_id', 'content_id', 'level', 'is_active'));
                $table->foreign('parent_id')->references('id')->on('menu_links')->onDelete('CASCADE');
                $table->foreign('content_id')->references('id')->on('contents')->onDelete('CASCADE');
            }
        );

        Schema::create(
            'menu_link_translations',
            function (Blueprint $table) {
                $table->increments('id');
                $table->integer('menu_link_id')->unsigned();
                $table->string('lang_code', 2);
                $table->string('title');
                $table->string('url');
                $table->string('alt');
                $table->boolean('is_current');
                $table->timestamps();
                $table->foreign('menu_link_id')->references('id')->on('menu_links')->onDelete('CASCADE');
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
        Schema::drop('menu_link_translations');
        Schema::drop('menu_links');
    }

}
