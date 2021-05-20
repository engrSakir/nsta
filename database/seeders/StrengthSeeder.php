<?php

namespace Database\Seeders;

use App\Models\Strength;
use Illuminate\Database\Seeder;

class StrengthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Strength::factory()->count(10)->create();
    }
}
