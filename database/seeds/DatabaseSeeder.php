<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $admins = [
            [
                'name' => "Administrator",
                'email' => "admin123@gmail.com",
                'password' => bcrypt('admin123'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
            /*[
                'name' => "Administrator2",
                'email' => "admin2@gmail.com",
                'password' => bcrypt('admin2'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]*/
        ];
        DB::table('admins')->insert($admins);

    }
}
