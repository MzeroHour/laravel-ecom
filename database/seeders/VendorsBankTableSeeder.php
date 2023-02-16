<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\VendorsBankDetail;

class VendorsBankTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $vendorsBankSeeder=['id'=>'1', 'vendor_id'=>'1', 'account_holder_name'=>'John', 'bank_name'=>'AYA Bank',
        'account_number'=>'12345Yangon', 'bank_ifsc_code'=>'Yangon'
    ];
    VendorsBankDetail::insert($vendorsBankSeeder);

    }
}
