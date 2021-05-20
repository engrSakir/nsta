<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(RoleAndPermissionSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(StaticOptionSeeder::class);
        $this->call(FaqSeeder::class);
        $this->call(BlogSeeder::class);
        $this->call(GallerySeeder::class);
        $this->call(TestimonialSeeder::class);
        $this->call(PartnerSeeder::class);
        $this->call(CustomPageSeeder::class);
        $this->call(StrengthSeeder::class);
        $this->call(ServiceSeeder::class);
        $this->call(PortfolioCategorySeeder::class);
        $this->call(PortfolioSeeder::class);
        $this->call(TeamSeeder::class);
        $this->call(PackageSeeder::class);
        $this->call(CompanySeeder::class);

        \App\Models\Invoice::factory(50)->create();
    }
}
