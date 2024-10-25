<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; // Corrected the case
use Illuminate\Support\Facades\DB; // Added this line

use App\Models\Role;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // this will remove the record from the table when performing seeder 
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');


        User::truncate();
        DB::table('users')->truncate();
        DB::table('businesses')->truncate();
        DB::table('role_user')->truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // this will get the roles from the role table 
        $adminRole = Role::where('name', 'admin')->first();  
        $userRole = Role::where('name', 'user')->first();
        $ownerRole = Role::where('name', 'owner')->first();

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
        foreach (range(1, 5) as $index) {
            $x++;
            $user1 = User::create([
                'name' => 'User' . $x,
                'email' => 'user' . $x . '@mail.com',
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
