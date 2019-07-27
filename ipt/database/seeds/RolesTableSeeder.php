<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;


class RolesTableSeeder extends Seeder
{
    public function run()
    {

    	DB::table('roles')->delete();

        
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();



        // create roles

        $role = Role::create(['name' => 'admin']);
        $role = Role::create(['name' => 'supervisor']);
        $role = Role::create(['name' => 'marker']);
        $role = Role::create(['name' => 'student']);
 
    }
}