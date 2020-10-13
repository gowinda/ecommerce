<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_list = array(
            array(
                'name' => 'Admin User',
                'email' => 'admin@admin.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin'
            ),
            array(
                'name' => 'Seller User',
                'email' => 'seller@seller.com',
                'password' => Hash::make('seller123'),
                'role' => 'seller'
            ),
            array(
                'name' => 'User User',
                'email' => 'user@user.com',
                'password' => Hash::make('user123'),
                'role' => 'user'
            )
        );

        DB::table('users')->insert($user_list);
    }
}
