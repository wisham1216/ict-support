<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(
            [
                PermissionSeeder::class,
                // RolesAndPermissionsSeeder::class
            ]

        );

        // Create admin user if doesn't exist
        $user = User::firstOrCreate(
            ['email' => 'wisham1216@gmail.com'],
            [
                'name' => 'Moosa wisam',
                'password' => bcrypt('password'), // Add a default password
                'email_verified_at' => now(),




            ]

        );

        $user->assignRole('super-admin');

        // $this->call([
        //     RolesAndPermissionsSeeder::class,
        //     // ...other seeders if any...
        // ]);
        //attach the roles and permissions seeder to the database seeder

        // $this->call([
        //     RolesAndPermissionsSeeder::class,
        //     // ...other seeders if any...

    }

}
