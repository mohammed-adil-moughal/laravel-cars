<?php

namespace Database\Seeders;

use App\Models\CarImage;
use Illuminate\Database\Seeder;

class CarImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CarImage::factory()->count(3)->create();
    }
}
