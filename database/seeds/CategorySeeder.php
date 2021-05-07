<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Electronics',
                'type' => 'products'
            ],
            [
                'name' => 'clothes',
                'type' => 'products'
            ],
            [
                'name' => 'Food',
                'type' => 'services'
            ],
            [
                'name' => 'phone bill',
                'type' => 'expenses'
            ],
            [
                'name' => 'renting bill',
                'type' => 'expenses'
            ],
        ];
        Category::create($data);
    }
}
