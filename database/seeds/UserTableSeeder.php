<?php

use Illuminate\Database\Seeder;
use App\User;


class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create(['name'=>"Nayeem",'email'=>'gdnayeem1996@gmail.com','password'=>bcrypt(123456)]);
        $user->givePermissionTo(['edit permission','view users', 'create users','delete users','edit users','view permission','create permission','edit permission','delete permission']);
        $user->assignRole('Admin');

    }
}
