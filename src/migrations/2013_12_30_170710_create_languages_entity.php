<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLanguagesEntity extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'langs',
            function (Blueprint $table) {
                $table->increments('id');
                $table->string('code');
                $table->string('i18n');
                $table->boolean('is_active');
                $table->boolean('is_default');
                $table->timestamps();
            }
        );

        $langs = [
            [
                'code'       => 'en',
                'i18n'       => 'en_UK',
                'is_active'  => 1,
                'is_default' => 1
            ],
            [
                'code'       => 'pl',
                'i18n'       => 'pl_PL',
                'is_active'  => 1,
                'is_default' => 0
            ],
            [
                'code'       => 'de',
                'i18n'       => 'de_DE',
                'is_active'  => 1,
                'is_default' => 0
            ],
            [
                'code'       => 'ru',
                'i18n'       => 'ru_RU',
                'is_active'  => 1,
                'is_default' => 0
            ],
            [
                'code'       => 'fr',
                'i18n'       => 'fr_FR',
                'is_active'  => 0,
                'is_default' => 0
            ]
        ];
        foreach ($langs as $lang) { // Insert langs is mandatory
            DB::table('langs')->insert($lang);
        }
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('langs');
    }

}
