<?php

namespace Database\Seeders;

use App\Models\Portfolio;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PortfolioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 6; $i++) {
            $portfolio = new Portfolio();
            $portfolio->short_title = 'Portfolio short title '.$i;
            $portfolio->long_title = 'Portfolio long title '.$i;
            $portfolio->short_description = 'Portfolio short description '.$i;
            $portfolio->long_description = 'Portfolio long description '.$i;
            $portfolio->category_id = $i;
            $portfolio->slug = Str::slug('portfolio short title '.$i, '-');
            $portfolio->save();
        }
    }
}
