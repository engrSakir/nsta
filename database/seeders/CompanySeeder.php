<?php

namespace Database\Seeders;

use App\Http\Controllers\Backend\Admin\BranchController;
use App\Models\Branch;
use App\Models\BranchLink;
use App\Models\Company;
use App\Models\CustomerAndBranch;
use App\Models\Package;
use App\Models\PurchaseMessage;

use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

                $company = new Company();
                $company->name = 'NSTA';
                $company->save();

                // 10 * 10 * 10 = 1000 branches
                for ($branch_counter = 1; $branch_counter <= 2; $branch_counter++) {
                    $branch = new Branch();
                    $branch->company_id = $company->id;
                    $branch->name = 'Branch -'. $branch_counter . ' of '. $company->name;
                    $branch->save();

                    $manager = new User();
                    $manager->type = 'Manager';
                    $manager->name = 'Manager'.$company->id.'-'.$branch->id;
                    $manager->email = $company->id.'-'.$branch->id.'-manager@gmail.com';
                    $manager->password = Hash::make('password');
                    $manager->company_id = $company->id;
                    $manager->branch_id = $branch->id;
                    $manager->save();

                }
    }
}
