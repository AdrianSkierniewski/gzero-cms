<?php namespace Gzero\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class TruncateSeeder extends Seeder {

    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('users')->truncate();
        DB::table('roles')->truncate();
        DB::table('content_types')->truncate();
        DB::table('content_translations')->truncate();
        DB::table('contents')->truncate();
        DB::table('block_types')->truncate();
        DB::table('block_translations')->truncate();
        DB::table('blocks')->truncate();
        DB::table('content_upload')->truncate();
        DB::table('uploads')->truncate();
        DB::table('upload_types')->truncate();
        DB::table('upload_translations')->truncate();
        DB::table('content_tag')->truncate();
        DB::table('tag_upload')->truncate();
        DB::table('tags')->truncate();
        DB::table('tag_translations')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

}
