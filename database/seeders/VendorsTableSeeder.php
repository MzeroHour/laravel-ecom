<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Vendor;

class VendorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $vendorRecords= ['id'=>1, 'name'=>'John', 'address'=>'No-123', 'city'=>'Yangon', 'state'=>'Yangon', 'country'=>'Myanmar', 'pincode'=>'11001', 'mobile'=>'970000',
    'email'=>'john@admin.com', 'status'=>0];

    Vendor::insert($vendorRecords);
    }
}
