<?php

use Illuminate\Database\Seeder;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Add Student
        DB::table('groups')->insert([
        	'name' => 'Student',
        	'description' => 'This group is for all students or learners.',
        	'status' => 1,
        	'created_at' => date('Y-m-d h:i:s'),
        	'updated_at' => date('Y-m-d h:i:s')
        	]);

        // Add Educator
        DB::table('groups')->insert([
        	'name' => 'Educator',
        	'description' => 'This group is for all educators.',
        	'status' => 1,
        	'created_at' => date('Y-m-d h:i:s'),
        	'updated_at' => date('Y-m-d h:i:s')
        	]);
    }
}
