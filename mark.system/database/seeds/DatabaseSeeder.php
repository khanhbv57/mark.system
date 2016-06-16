<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('users')->insert([
        'name' => 'Administrator',
        'email' => 'admin@gmail.com',
        'password' => Hash::make('123456')
      ]);

      DB::table('users')->insert([
        'name' => 'Bế Văn Khánh',
        'email' => 'khanhbv57@gmail.com',
        'password' => Hash::make('123456')
      ]);

      DB::table('roles')->insert([
        'name' => 'admin',
        'display_name' => 'Administrator',
      ]);

      DB::table('roles')->insert([
        'name' => 'teacher',
        'display_name' => 'Teacher',
      ]);

      DB::table('role_user')->insert([
        'user_id' => 1,
        'role_id' => 1
      ]);

      DB::table('role_user')->insert([
        'user_id' => 2,
        'role_id' => 2
      ]);

        // $this->call(UserTableSeeder::class);
    	DB::table('years')->insert([
        'year_title' => '2015',
        'year_active' => 1
      ]);

      DB::table('years')->insert([
    		'year_title' => '2014',
        'year_active' => 0
    	]);

    	

    	DB::table('semesters')->insert([
    		'semester_title' => 'Học kỳ một',
        'year_id' => 1
    	]);

    	DB::table('semesters')->insert([
    		'semester_title' => 'Học kỳ hai',
        'year_id' => 2
    	]);

      DB::table('subjects')->insert([
        'subject_code' => 'INT2204 1',
        'subject_title' => 'Lập trình hướng đối tượng',
        'semester_id' => '1',
      ]);

      DB::table('subjects')->insert([
        'subject_code' => 'INT2204 5',
        'subject_title' => 'Lập trình nâng cao',
        'semester_id' => '1',
      ]);

      DB::table('subjects')->insert([
        'subject_code' => 'INT3108 1',
        'subject_title' => 'Lập trình hệ thống nhúng',
        'semester_id' => '1',
      ]);      
    }
}
