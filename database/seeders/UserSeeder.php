<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = 'Admin';
        $user->email = 'admin@gmail.com';
        $user->username = 'admin';
        $user->password = Hash::make('@Admin!23#');
        $user->email_verified_at = date("Y-m-d",time());
        $user->save();
        $user->assign('Admin');
    }
}
