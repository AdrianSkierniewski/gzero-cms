<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBlocksEntity extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'block_types',
            function (Blueprint $table) {
                $table->increments('id');
                $table->string('name')->unique();
                $table->timestamps();
            }
        );

        Schema::create(
            'blocks',
            function (Blueprint $table) {
                $table->increments('id');
                $table->integer('type_id')->unsigned();
                $table->integer('menu_id')->unsigned()->nullable();
                $table->string('region', 255)->nullable();
                $table->boolean('is_cacheable')->default(1);
                $table->boolean('is_active');
                $table->binary('options');
                $table->timestamps();
                $table->softDeletes();
                $table->foreign('type_id')->references('id')->on('block_types')->onDelete('CASCADE');
                $table->foreign('menu_id')->references('id')->on('menu_links')->onDelete('CASCADE');
            }
        );

        Schema::create(
            'block_translations',
            function (Blueprint $table) {
                $table->increments('id');
                $table->integer('block_id')->unsigned();
                $table->string('lang_code', 2);
                $table->string('sites', 255)->nullable();
                $table->string('title');
                $table->string('body');
                $table->boolean('is_active');
                $table->timestamps();
                $table->foreign('block_id')->references('id')->on('blocks')->onDelete('CASCADE');
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
        Schema::drop('block_translations');
        Schema::drop('blocks');
        Schema::drop('block_types');
    }

}
