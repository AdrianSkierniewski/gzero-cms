<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUploadsEntity extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'upload_types',
            function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->timestamps();
            }
        );

        Schema::create(
            'uploads',
            function (Blueprint $table) {
                $table->increments('id');
                $table->integer('type_id')->unsigned();
                $table->string('path');
                $table->string('mime');
                $table->integer('size');
                $table->timestamps();
                $table->foreign('type_id')->references('id')->on('upload_types')->onDelete('RESTRICT');
            }
        );

        Schema::create(
            'upload_translations',
            function (Blueprint $table) {
                $table->increments('id');
                $table->integer('upload_id')->unsigned();
                $table->integer('lang_id')->unsigned();
                $table->string('name');
                $table->boolean('is_active');
                $table->timestamps();
                $table->foreign('upload_id')->references('id')->on('uploads')->onDelete('CASCADE');
                $table->foreign('lang_id')->references('id')->on('langs')->onDelete('CASCADE');
            }
        );

        Schema::create(
            'content_upload',
            function (Blueprint $table) {
                $table->integer('content_id')->unsigned();
                $table->integer('upload_id')->unsigned();
                $table->timestamps();
                $table->unique(array('content_id', 'upload_id')); // Multiple attach constraint
                $table->foreign('content_id')->references('id')->on('contents')->onDelete('CASCADE');
                $table->foreign('upload_id')->references('id')->on('uploads')->onDelete('CASCADE');
            }
        );

        Schema::create(
            'block_upload',
            function (Blueprint $table) {
                $table->integer('block_id')->unsigned();
                $table->integer('upload_id')->unsigned();
                $table->timestamps();
                $table->unique(array('block_id', 'upload_id')); // Multiple attach constraint
                $table->foreign('block_id')->references('id')->on('blocks')->onDelete('CASCADE');
                $table->foreign('upload_id')->references('id')->on('uploads')->onDelete('CASCADE');
            }
        );

        Schema::table(
            'contents',
            function (Blueprint $table) {
                $table->integer('thumb_id')->unsigned()->nullable()->after('type_id');
                $table->foreign('thumb_id')->references('id')->on('uploads')->onDelete('SET NULL');
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
            'contents',
            function (Blueprint $table) {
                $table->dropForeign('contents_thumb_id_foreign');
            }
        );
        Schema::drop('block_upload');
        Schema::drop('content_upload');
        Schema::drop('upload_translations');
        Schema::drop('uploads');
        Schema::drop('upload_types');
    }

}
