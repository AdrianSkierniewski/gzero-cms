<?php namespace Gzero\Seeds;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Eloquent::unguard();
        $this->call('Gzero\Seeds\TruncateSeeder');
        $this->call('Gzero\Seeds\UsersSeeder');
        $this->call('Gzero\Seeds\ContentTypesSeeder');
        $this->call('Gzero\Seeds\ContentsSeeder');
        $this->call('Gzero\Seeds\UploadsSeeder');
        $this->call('Gzero\Seeds\MenuLinksSeeder');
        $this->call('Gzero\Seeds\BlockTypesSeeder');
        $this->call('Gzero\Seeds\BlocksSeeder');
        $this->call('Gzero\Seeds\TagsSeeder');
    }

}
