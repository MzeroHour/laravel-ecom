<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\VendorsBusinessDetail;

class VendorsBusinessDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $vendorsBusinessDetails=['id'=>'1', 'vendor_id'=>1, 'shop_name'=>'John Electronic Store',
    'shop_address'=>'No-123', 'shop_city'=>'Yangon', 'shop_state'=>'Yangon', 'shop_country'=>'Myanamr',
'shop_pincode'=>'1101', 'shop_mobile'=>'09-425008234', 'shop_website'=>'www.www.com', 'shop_email'=>'john@admin.com',
'address_proof'=>'Passport', 'address_proof_image'=>'test.jpg', 'business_license_number'=>'01234', 'gst_number'=>'gst-123',
'pan_number'=>'12345678'
];
VendorsBusinessDetail::insert($vendorsBusinessDetails);
    }
}
