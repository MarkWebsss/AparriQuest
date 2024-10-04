<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\support\facades\Hash;

	use App\Models\Role;
	use App\Models\User;

	use DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
     
        // this will remove the record from the table when performing seeder 
        User::truncate();
        DB::table('role_user')->truncate();
        
        // ths will get the roles from the role table 
        $adminRole = Role::Where('name', 'admin')->first();  
        $userRole = Role::Where('name', 'user')->first();
        $ownerRole = Role::Where('name', 'owner')->first();

        // this will define the users credentials and adds to the table users 
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@mail.com',
            'password' => Hash::make('admin')
        ]);

        $user = User::create([
            'name' => 'User',
            'email' => 'user@mail.com',
            'password' => Hash::make('user')
        ]);

        $owner = User::create([
            'name' => 'Shop Owner',
            'email' => 'owner@gmail.com',
            'password' => Hash::make('shop')
        ]);

            $x = 0;
            foreach(range(1,20) as $index)
            {
                $x++;
                $user1 = User::create([
                    'name' => 'User'.$x,
                    'email' => 'user'.$x.'@mail.com',
                    'password' => Hash::make('user')
                ]);

                $user1->roles()->attach($userRole);
            }




        // this will attach the roles to the user account 
        $admin->roles()->attach($adminRole);

        $user->roles()->attach($userRole);

        $owner->roles()->attach($ownerRole);

   
    }
}
