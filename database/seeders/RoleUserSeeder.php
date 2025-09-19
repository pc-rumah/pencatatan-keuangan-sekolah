<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::findorCreate('admin');
        $staff = Role::findorCreate('staff');

        $adminCrete = User::firstorCreate([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password')
        ]);

        $staffCreate = User::firstorCreate([
            'name' => 'staff',
            'email' => 'staff@example.com',
            'password' => Hash::make('password'),
        ]);

        $adminCrete->assignRole('admin');
        $staffCreate->assignRole('staff');

        $this->command->info('Role & User Seeder Berhasil');
    }
}
