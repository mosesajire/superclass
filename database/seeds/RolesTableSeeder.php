<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	// Add registered users
        DB::table('roles')->insert([
        	'name' => 'Registered',
        	'description' => 'This role is for all registered users.',
        	'created_at' => date('Y-m-d h:i:s'),
        	'updated_at' => date('Y-m-d h:i:s')
        	]);

        // Add admin users
        DB::table('roles')->insert([
        	'name' => 'Admin',
        	'description' => 'This role is for all website administrators.',
        	'created_at' => date('Y-m-d h:i:s'),
        	'updated_at' => date('Y-m-d h:i:s')
        	]);
    }
}
