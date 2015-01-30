<?php

class UserTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->delete();

        User::create(
            array(
            'email' => 'mja@mja.lv',
            'password' => 'password',
            'api_key' => sha1('key#1')
            )
        );

        User::create(
            array(
            'email' => 'seconduser@example.org',
            'password' => 'second_password',
            'api_key' => sha1('key#2')
            )
        );
    }
}
