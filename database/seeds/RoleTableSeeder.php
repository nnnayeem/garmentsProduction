<?php

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create(['name' => 'Admin']);
        $role->givePermissionTo(['view users', 
			'create users', 
			'edit users', 
			'delete users', 
			'view permission', 
			'create permission', 
			'edit permission', 
			'delete permission', 
			'view floors', 
			'create floors', 
			'edit floors', 
			'delete floors', 
			'view machines', 
			'create machines', 
			'edit machines',
			'delete machines', 
			'view machine-category', 
			'create machine-category', 
			'edit machine-category', 
			'delete machine-category', 
			'view request-platform', 
			'create request-platform',
			'edit request-platform', 
			'delete request-platform', 
			'delete approve request', 
			'approve request', 
			'deliver request', 
			'delete deliver request',
			'view store', 
			'create store', 
			'edit store', 
			'delete store',
			'view parts', 
			'create parts',
			'edit parts',
			'delete parts', 
			'view machine-history', 
			'view order', 
			'create order', 
			'edit order', 
			'delete order',
			'view accessories',
			'create accessories',
			'edit accessories', 
			'delete accessories',
			'update accessories',
			'input accessories', 
			'view buyer',
			'create buyer', 
			'edit buyer', 
			'delete buyer', 
			'view general-store', 
			'edit general-store',
			'request accessories', 
			'deliver accessories',
			'delete general-store', 
			'all buyer',
			'view role',
			'create role',
			'edit role',
			'delete role',
           ]);
		$role = Role::create(['name' => 'Merchantiser']);
        $role->givePermissionTo([ 
			'approve request',
			'view store', 
			'view order', 
			'create order',
			'edit order', 
			'delete order', 
			'view accessories',
			'create accessories', 
			'edit accessories', 
			'delete accessories',
			'update accessories', 
			'input accessories', 
			'view buyer', 
			'create buyer',
			'edit buyer', 
			'delete buyer',
			'view general-store',
			'own buyer',
			'view target',
			'create target',
			'edit target',
			'delete target'  
           ]);



    }
}
