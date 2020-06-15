<?php

use Illuminate\Database\Seeder;

class SubjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Add English Language
        DB::table('subjects')->insert([
        	'user_id' => 1,
        	'name' => 'English Language',
        	'description' => 'This is for English Language.',
        	'status' => 1,
        	'created_at' => date('Y-m-d h:i:s'),
        	'updated_at' => date('Y-m-d h:i:s')
        	]);

         // Add Mathematics
        DB::table('subjects')->insert([
        	'user_id' => 1,
        	'name' => 'Mathematics',
        	'description' => 'This is for Mathematics.',
        	'status' => 1,
        	'created_at' => date('Y-m-d h:i:s'),
        	'updated_at' => date('Y-m-d h:i:s')
        	]);

        // Physics
        DB::table('subjects')->insert([
        	'user_id' => 1,
        	'name' => 'Physics',
        	'description' => 'This is for Physics.',
        	'status' => 1,
        	'created_at' => date('Y-m-d h:i:s'),
        	'updated_at' => date('Y-m-d h:i:s')
        	]);

        // Chemistry
        DB::table('subjects')->insert([
        	'user_id' => 1,
        	'name' => 'Chemistry',
        	'description' => 'This is for Chemistry.',
        	'status' => 1,
        	'created_at' => date('Y-m-d h:i:s'),
        	'updated_at' => date('Y-m-d h:i:s')
        	]);

        // Biology
        DB::table('subjects')->insert([
        	'user_id' => 1,
        	'name' => 'Biology',
        	'description' => 'This is for Biology.',
        	'status' => 1,
        	'created_at' => date('Y-m-d h:i:s'),
        	'updated_at' => date('Y-m-d h:i:s')
        	]);

        // Civic Education
        DB::table('subjects')->insert([
        	'user_id' => 1,
        	'name' => 'Civic Education',
        	'description' => 'This is for Civic Education.',
        	'status' => 1,
        	'created_at' => date('Y-m-d h:i:s'),
        	'updated_at' => date('Y-m-d h:i:s')
        	]);

        // Economics
        DB::table('subjects')->insert([
        	'user_id' => 1,
        	'name' => 'Economics',
        	'description' => 'This is for Economics.',
        	'status' => 1,
        	'created_at' => date('Y-m-d h:i:s'),
        	'updated_at' => date('Y-m-d h:i:s')
        	]);

        // Geography
        DB::table('subjects')->insert([
        	'user_id' => 1,
        	'name' => 'Geography',
        	'description' => 'This is for Geography.',
        	'status' => 1,
        	'created_at' => date('Y-m-d h:i:s'),
        	'updated_at' => date('Y-m-d h:i:s')
        	]);

        // Government
        DB::table('subjects')->insert([
        	'user_id' => 1,
        	'name' => 'Government',
        	'description' => 'This is for Government.',
        	'status' => 1,
        	'created_at' => date('Y-m-d h:i:s'),
        	'updated_at' => date('Y-m-d h:i:s')
        	]);

        // Literature
        DB::table('subjects')->insert([
        	'user_id' => 1,
        	'name' => 'Literature in English',
        	'description' => 'This is for Literature in English.',
        	'status' => 1,
        	'created_at' => date('Y-m-d h:i:s'),
        	'updated_at' => date('Y-m-d h:i:s')
        	]);

        // Computer Science
        DB::table('subjects')->insert([
        	'user_id' => 1,
        	'name' => 'Computer Science',
        	'description' => 'This is for Computer Science.',
        	'status' => 1,
        	'created_at' => date('Y-m-d h:i:s'),
        	'updated_at' => date('Y-m-d h:i:s')
        	]);

        // Accounting
        DB::table('subjects')->insert([
        	'user_id' => 1,
        	'name' => 'Accounting',
        	'description' => 'This is for Accounting.',
        	'status' => 1,
        	'created_at' => date('Y-m-d h:i:s'),
        	'updated_at' => date('Y-m-d h:i:s')
        	]);
    }
}
