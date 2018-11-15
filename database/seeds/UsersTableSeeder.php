<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\User::class,10)->create();
        $user=\App\User::find(1);
        $user->name='范瑞';
        $user->email='437294469@qq.com';
        $user->password=bcrypt('123');
        $user->is_admin=true;
        $user->save();
    }
}
