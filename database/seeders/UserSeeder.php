<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
        $user->type = 'Super Admin';
        $user->name = 'Super Admin';
        $user->email = 'superadmin@gmail.com';
        $user->phone = '01857110581';
        $user->username = 'superadmin';
        $user->password = Hash::make('password');
        $user->save();

        $user = new User();
        $user->type = 'Admin';
        $user->name = 'Admin';
        $user->company_id = 1;
        $user->email = 'admin@gmail.com';
        $user->phone = '01304734623';
        $user->username = 'admin';
        $user->password = Hash::make('password');
        $user->save();

        $user = new User();
        $user->type = 'Manager';
        $user->name = 'Manager';
        $user->email = 'manager@gmail.com';
        $user->phone = '01304734624';
        $user->username = 'manager';
        $user->password = Hash::make('password');
        $user->company_id = 1;
        $user->branch_id = 1;
        $user->save();

        $user = new User();
        $user->type = 'Customer';
        $user->name = 'Customer';
        $user->email = 'customer@gmail.com';
        $user->phone = '01304734625';
        $user->username = 'customer';
        $user->password = Hash::make('password');
        $user->save();
    }
}
