<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class AdminRolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions

        // permits actions on admin accounts - super admin only
        Permission::create(['name' => 'make staff admin']);
        Permission::create(['name' => 'delete admin account']);
        Permission::create(['name' => 'get all admin account']);

        $superAdminRole = Role::create(['name' => 'superAdmin']);
        $superAdminRole->givePermissionTo('make staff admin');
        $superAdminRole->givePermissionTo('delete admin account');
        $superAdminRole->givePermissionTo('get all admin account');



        // permits actions on staff accounts - admins only
        Permission::create(['name' => 'verify staff account']);
        Permission::create(['name' => 'delete staff account']);
        Permission::create(['name' => 'get all staff account']);

        $superAdminRole = Role::create(['name' => 'admin']);
        $superAdminRole->givePermissionTo('verify staff account');
        $superAdminRole->givePermissionTo('delete staff account');
        $superAdminRole->givePermissionTo('get all staff account');

        // permits pharm actions
        Permission::create(['name' => 'pharm actions']); // this includes substitute. delete, update, add new drugs

        // Create pharm roles and assign existing permissions
        $pharmacist = Role::create(['name' => 'pharmacist']);
        $pharmacist->givePermissionTo('pharm actions');
        // $pharmacist->givePermissionTo('substitute prescription');


    // Create lab scientist roles and assign existing permissions
        Permission::create(['name' => 'create lab test']);
        Permission::create(['name' => 'modify lab test']);
        Permission::create(['name' => 'delete lab result']);
        Permission::create(['name' => 'create lab result']);
        Permission::create(['name' => 'modify lab result']);

        $labTech = Role::create(['name' => 'labTech']);
        $labTech->givePermissionTo('create lab result');
        $labTech->givePermissionTo('modify lab result');
        $labTech->givePermissionTo('delete lab result');
        $labTech->givePermissionTo('create lab test');
        $labTech->givePermissionTo('modify lab test');


         // create doctor roles and assign permissions
        Permission::create(['name' => 'create prescription']);
        Permission::create(['name' => 'modify prescription']);
        Permission::create(['name' => 'cancel lab test']);
        Permission::create(['name' => 'view patient history']);
        
        $doctors = Role::create(['name' => 'doctor']);
        $doctors->givePermissionTo('create prescription');
        $doctors->givePermissionTo('modify prescription');
        $doctors->givePermissionTo('create lab test');
        $labTech->givePermissionTo('cancel lab test');
        $labTech->givePermissionTo('view patient history');

        

        // Create frontdesk/receptionist roles and assign existing permissions
        Permission::create(['name' => 'create appointment']);
        Permission::create(['name' => 'view patient account']);

        $frontDesk = Role::create(['name' => 'frontDesk']);
        $frontDesk->givePermissionTo('create appointment');
        $frontDesk->givePermissionTo('view patient account');

        //  grant superadmin all permissions
        $superAdminRole->givePermissionTo(Permission::all());
    }
}
