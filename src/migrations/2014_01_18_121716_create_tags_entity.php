<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTagsEntity extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'tags',
            function (Blueprint $table) {
                $table->increments('id');
                $table->boolean('is_active');
                $table->timestamps();
            }
        );

        Schema::create(
            'content_tag',
            function (Blueprint $table) {
                $table->increments('id');
                $table->integer('content_id')->unsigned();
                $table->integer('tag_id')->unsigned();
                $table->timestamps();
                $table->unique(array('tag_id', 'content_id')); // Multiple attach constraint
                $table->foreign('content_id')->references('id')->on('contents')->onDelete('CASCADE');
                $table->foreign('tag_id')->references('id')->on('tags')->onDelete('CASCADE');
            }
        );

        Schema::create(
            'tag_upload',
            function (Blueprint $table) {
                $table->increments('id');
                $table->integer('upload_id')->unsigned();
                $table->integer('tag_id')->unsigned();
                $table->timestamps();
                $table->unique(array('tag_id', 'upload_id')); // Multiple attach constraint
                $table->foreign('upload_id')->references('id')->on('uploads')->onDelete('CASCADE');
                $table->foreign('tag_id')->references('id')->on('tags')->onDelete('CASCADE');
            }
        );

        Schema::create(
            'tag_translations',
            function (Blueprint $table) {
                $table->increments('id');
                $table->integer('tag_id')->unsigned();
                $table->string('lang_code', 2);
                $table->string('name');
                $table->boolean('is_active');
                $table->timestamps();
                $table->foreign('tag_id')->references('id')->on('tags')->onDelete('CASCADE');
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
        Schema::drop('content_tag');
        Schema::drop('tag_upload');
        Schema::drop('tag_translations');
        Schema::drop('tags');
    }

}
