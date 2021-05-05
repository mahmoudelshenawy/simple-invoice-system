<?php

use Illuminate\Database\Seeder;
use App\Profile;

class ProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Profile::create([
            'name' => 'Mahmoud',
            'tin' => 'E01224500',
            'image' => '1.jpg',
            'user_id' => 1
        ]);
    }
}
