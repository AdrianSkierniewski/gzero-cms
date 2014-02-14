<?php namespace Gzero\Seeds;

use Gzero\Models\Role;
use Gzero\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class UsersSeeder extends Seeder {

    public function run()
    {
        $user = User::create(
            [
                'email'      => 'admin@admin.com',
                'first_name' => 'John',
                'last_name'  => 'Doe',
                'password'   => Hash::make('test123'),
                'is_active'  => 1
            ]
        );

        $role = Role::create(
            [
                'name' => 'admin'
            ]
        );

        $user->roles()->attach($role->id);
    }
}
