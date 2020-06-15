<?php

use Illuminate\Database\Seeder;

class PackagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         // Add JSS 1
        DB::table('packages')->insert([
        	'user_id' => 1,
        	'name' => 'JSS 1',
        	'description' => 'This package is for Junior Secondary School 1 students.',
        	'status' => 1,
        	'created_at' => date('Y-m-d h:i:s'),
        	'updated_at' => date('Y-m-d h:i:s')
        	]);

       	// Add JSS 2
        DB::table('packages')->insert([
        	'user_id' => 1,
        	'name' => 'JSS 2',
        	'description' => 'This package is for Junior Secondary School 2 students.',
        	'status' => 1,
        	'created_at' => date('Y-m-d h:i:s'),
        	'updated_at' => date('Y-m-d h:i:s')
        	]);

        // Add JSS 3
        DB::table('packages')->insert([
        	'user_id' => 1,
        	'name' => 'JSS 3',
        	'description' => 'This package is for Junior Secondary School 3 students.',
        	'status' => 1,
        	'created_at' => date('Y-m-d h:i:s'),
        	'updated_at' => date('Y-m-d h:i:s')
        	]);

        // Add SSS 1
        DB::table('packages')->insert([
        	'user_id' => 1,
        	'name' => 'SSS 1',
        	'description' => 'This package is for Senior Secondary School 1 students.',
        	'status' => 1,
        	'created_at' => date('Y-m-d h:i:s'),
        	'updated_at' => date('Y-m-d h:i:s')
        	]);

        // Add SSS 2
        DB::table('packages')->insert([
        	'user_id' => 1,
        	'name' => 'SSS 2',
        	'description' => 'This package is for Senior Secondary School 2 students.',
        	'status' => 1,
        	'created_at' => date('Y-m-d h:i:s'),
        	'updated_at' => date('Y-m-d h:i:s')
        	]);

        // Add SSS 3
        DB::table('packages')->insert([
        	'user_id' => 1,
        	'name' => 'SSS 3',
        	'description' => 'This package is for Senior Secondary School 3 students.',
        	'status' => 1,
        	'created_at' => date('Y-m-d h:i:s'),
        	'updated_at' => date('Y-m-d h:i:s')
        	]);
    }
}
