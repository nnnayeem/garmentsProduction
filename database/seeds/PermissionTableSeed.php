<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name'=>'view users','guard_name'=>'web']);
        Permission::create(['name'=>'create users','guard_name'=>'web']);
        Permission::create(['name'=>'edit users','guard_name'=>'web']);
        Permission::create(['name'=>'delete users','guard_name'=>'web']);

        Permission::create(['name'=>'view permission','guard_name'=>'web']);
        Permission::create(['name'=>'create permission','guard_name'=>'web']);
        Permission::create(['name'=>'edit permission','guard_name'=>'web']);
        Permission::create(['name'=>'delete permission','guard_name'=>'web']);

        Permission::create(['name'=>'view floors','guard_name'=>'web']);
        Permission::create(['name'=>'create floors','guard_name'=>'web']);
        Permission::create(['name'=>'edit floors','guard_name'=>'web']);
        Permission::create(['name'=>'delete floors','guard_name'=>'web']);

        Permission::create(['name'=>'view machines','guard_name'=>'web']);
        Permission::create(['name'=>'create machines','guard_name'=>'web']);
        Permission::create(['name'=>'edit machines','guard_name'=>'web']);
        Permission::create(['name'=>'delete machines','guard_name'=>'web']);

        Permission::create(['name'=>'view machine-category','guard_name'=>'web']);
        Permission::create(['name'=>'create machine-category','guard_name'=>'web']);
        Permission::create(['name'=>'edit machine-category','guard_name'=>'web']);
        Permission::create(['name'=>'delete machine-category','guard_name'=>'web']);

        Permission::create(['name'=>'view request-platform','guard_name'=>'web']);
        Permission::create(['name'=>'create request-platform','guard_name'=>'web']);
        Permission::create(['name'=>'edit request-platform','guard_name'=>'web']);
        Permission::create(['name'=>'delete request-platform','guard_name'=>'web']);
        Permission::create(['name'=>'delete approve request','guard_name'=>'web']);
        Permission::create(['name'=>'approve request','guard_name'=>'web']);
        Permission::create(['name'=>'deliver request','guard_name'=>'web']);
        Permission::create(['name'=>'delete deliver request','guard_name'=>'web']);

        Permission::create(['name'=>'view store','guard_name'=>'web']);
        Permission::create(['name'=>'create store','guard_name'=>'web']);
        Permission::create(['name'=>'edit store','guard_name'=>'web']);
        Permission::create(['name'=>'delete store','guard_name'=>'web']);

        Permission::create(['name'=>'view parts','guard_name'=>'web']);
        Permission::create(['name'=>'create parts','guard_name'=>'web']);
        Permission::create(['name'=>'edit parts','guard_name'=>'web']);
        Permission::create(['name'=>'delete parts','guard_name'=>'web']);

        Permission::create(['name'=>'view machine-history','guard_name'=>'web']);

        Permission::create(['name'=>'view order','guard_name'=>'web']);
        Permission::create(['name'=>'create order','guard_name'=>'web']);
        Permission::create(['name'=>'edit order','guard_name'=>'web']);
        Permission::create(['name'=>'delete order','guard_name'=>'web']);

        Permission::create(['name'=>'view accessories','guard_name'=>'web']);
        Permission::create(['name'=>'create accessories','guard_name'=>'web']);
        Permission::create(['name'=>'edit accessories','guard_name'=>'web']);
        Permission::create(['name'=>'delete accessories','guard_name'=>'web']);
        Permission::create(['name'=>'update accessories','guard_name'=>'web']);
        Permission::create(['name'=>'input accessories','guard_name'=>'web']);

        Permission::create(['name'=>'view buyer','guard_name'=>'web']);
        Permission::create(['name'=>'create buyer','guard_name'=>'web']);
        Permission::create(['name'=>'edit buyer','guard_name'=>'web']);
        Permission::create(['name'=>'delete buyer','guard_name'=>'web']);
    }
}
