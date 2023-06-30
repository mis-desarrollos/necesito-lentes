<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()['cache']->forget('spatie.permission.cache');
        Permission::create(['name' => 'configuration']);
        Permission::create(['name' => 'users']);
        Permission::create(['name' => 'orders']);
        /*Permission::create(['name' => 'products']);
        Permission::create(['name' => 'categories']);
        Permission::create(['name' => 'subcategories']);
        Permission::create(['name' => 'customers']);*/
        Permission::create(['name' => 'customers']);
        Permission::create(['name' => 'blogs']);
        Permission::create(['name' => 'banners']);

        Permission::create(['name' => 'materials']);
        Permission::create(['name' => 'packages']);
        Permission::create(['name' => 'products']);
        Permission::create(['name' => 'opticians']);
        Permission::create(['name' => 'exams']);
        Permission::create(['name' => 'newslatter']);
        Permission::create(['name' => 'coverings']);
        Permission::create(['name' => 'accountstatus']);
        $admins = Role::create(['name' => 'administrador']);
        $admins->givePermissionTo('configuration');
        $admins->givePermissionTo('users');
        $admins->givePermissionTo('orders');
        /*$admins->givePermissionTo('products');
        $admins->givePermissionTo('categories');
        $admins->givePermissionTo('subcategories');
        $admins->givePermissionTo('customers');*/
        $admins->givePermissionTo('customers');
        $admins->givePermissionTo('blogs');
        $admins->givePermissionTo('banners');
        $admins->givePermissionTo('materials');
        $admins->givePermissionTo('packages');
        $admins->givePermissionTo('products');
        $admins->givePermissionTo('opticians');
        $admins->givePermissionTo('exams');
        $admins->givePermissionTo('newslatter');
        $admins->givePermissionTo('coverings');
        $customer = Role::create(['name' => 'cliente']);
        

        $optica = Role::create(['name' => 'optica']);

        $optica->givePermissionTo('accountstatus');
        $optica->givePermissionTo('customers');
        $optica->givePermissionTo('exams');
    }
}
