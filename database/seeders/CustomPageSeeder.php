<?php

namespace Database\Seeders;

use App\Models\CustomPage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CustomPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customPage = new CustomPage();
        $customPage->is_active = true;
        $customPage->name = 'Terms & Conditions';
        $customPage->title = 'Terms & Conditions';
        $customPage->description = 'Terms & Conditions --- description';
        $customPage->slug = Str::slug('Terms & Conditions');
        $customPage->serial = 1;
        $customPage->save();

        $customPage = new CustomPage();
        $customPage->is_active = true;
        $customPage->name = 'Privacy & policy';
        $customPage->title = 'Privacy & policy';
        $customPage->description = 'Privacy & policy --- description';
        $customPage->slug = Str::slug('Privacy & policy');
        $customPage->serial = 2;
        $customPage->save();
    }
}
