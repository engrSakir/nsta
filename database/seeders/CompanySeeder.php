<?php

namespace Database\Seeders;

use App\Http\Controllers\Backend\Admin\BranchController;
use App\Models\Branch;
use App\Models\BranchLink;
use App\Models\Company;
use App\Models\CustomerAndBranch;
use App\Models\Package;
use App\Models\PurchaseMessage;
use App\Models\PurchasePackage;
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
        //10 package
        for ($package_counter = 1; $package_counter <= 2; $package_counter++) {
            $package = new Package();
            $package->name = 'Package - '.$package_counter;
            $package->branch = $faker->numberBetween(1,10);
            $package->admin = $faker->numberBetween(1,10);
            $package->manager = $faker->numberBetween(1,10);
            $package->customer = $faker->numberBetween(50,500);
            $package->invoice = $faker->numberBetween(50,500);
            $package->free_sms = $faker->numberBetween(50,500);
            $package->price_per_message =  $faker->numberBetween(0.30,0.60);
            $package->save();
            //10 * 10 = 100 company
            for ($company_counter = 1; $company_counter <= 5; $company_counter++) {
                $company = new Company();
                $company->name = 'Company ' . $company_counter;
                $company->save();
                // 10 * 10 * 3 = 300 purchase package
                for ($purchase_package_counter = 1; $purchase_package_counter <= 3; $purchase_package_counter++) {
                    $purchase_package = new PurchasePackage();
                    $purchase_package->company_id = $company->id;
                    $purchase_package->package_id = $package->id;
                    $purchase_package->save();
                }
                // 10 * 10 * 3 = 300 time purchase message
                for ($purchase_message_counter = 1; $purchase_message_counter <= 3; $purchase_message_counter++) {
                    $purchase_message = new PurchaseMessage();
                    $purchase_message->company_id = $company->id;
                    $purchase_message->purchaser_id = $package->id;
                    $purchase_message->message_amount = Package::find($purchase_message_counter)->free_sms;
                    $purchase_message->price_per_message = Package::find($purchase_message_counter)->price_per_message;
                    $purchase_message->package_id = $purchase_package->id;
                    $purchase_message->save();
                }
                // 10 * 10 * 10 = 1000 branches
                for ($branch_counter = 1; $branch_counter <= 10; $branch_counter++) {
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

                    // 10 * 10 * 10 * 10 = 10000 links branches
                    for ($linked_branch_counter = 1; $linked_branch_counter <= 10; $linked_branch_counter++) {
                        $linked_branch = new BranchLink();
                        $linked_branch->from_branch_id = $branch->id;
                        $linked_branch->to_branch_id = $linked_branch_counter;
                        $linked_branch->save();
                    }

                    // 10 * 10 * 10 * 10 = 10000 customers and linked with branch
                    for ($branch_customer_counter = 1; $branch_customer_counter <= 10; $branch_customer_counter++) {
                        $customer = new User();
                        $customer->type = 'Customer';
                        $customer->name = 'Customer v-'.$company->id.'-'.$branch->id.'-'.$branch_customer_counter;
                        $customer->email = $company->id.'-'.$branch->id.'-'.$branch_customer_counter.'-customer@gmail.com';
                        $customer->password = Hash::make('password');
                        $customer->save();

                        $customer_and_branch = new CustomerAndBranch();
                        $customer_and_branch->branch_id = $branch->id;
                        $customer_and_branch->user_id = $customer->id;
                        $customer_and_branch->save();
                    }

                }

            }
        }
    }
}
