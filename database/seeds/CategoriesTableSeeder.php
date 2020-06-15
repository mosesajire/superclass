<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
        	'name' => 'Uncategorised',
        	'description' => 'This is for contents without a category.',
        	'status' => 1,
        	'user_id' => 1,
        	'created_at' => date('Y-m-d h:i:s'),
        	'updated_at' => date('Y-m-d h:i:s')
        	]);
    }
}
