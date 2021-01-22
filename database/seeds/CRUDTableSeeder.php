<?php

use App\crud;
use Illuminate\Database\Seeder;

class CRUDTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Truncate
        crud::truncate();
        // Create
        crud::create([
            'name' => 'Charnel S. Clamosa',
            'gender' => 'Male',
            'age' => '26',
            'address' => 'Cavite, Philippines',
        ]);
    }
}
