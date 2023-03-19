<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProdcutsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $productRecords=[
            [
                'id'=>1,
                'section_id'=>2,
                'category_id'=>7,
                'brand_id'=>8,
                'vendor_id'=>1,
                'admin_type'=>'vendor',
                'product_name'=>'iPhone',
                'product_code'=>'RN11',
                'product_color'=>'Silver',
                'product_price'=>3000,
                'product_discount'=>10,
                'product_weight'=>500,
                'product_image'=>'',
                'product_video'=>'',
                'description'=>'',
                'meta_title'=>'',
                'meta_description'=>'',
                'meta_metakeywords'=>'',
                'is_featured'=>'Yes',
                'status'=>1
            ],
            [
                'id'=>2,
                'section_id'=>2,
                'category_id'=>8,
                'brand_id'=>2,
                'vendor_id'=>1,
                'admin_type'=>'superadmin',
                'product_name'=>'Black Cusual T-Shirt',
                'product_code'=>'RC001',
                'product_color'=>'Black',
                'product_price'=>150,
                'product_discount'=>20,
                'product_weight'=>100,
                'product_image'=>'',
                'product_video'=>'',
                'description'=>'',
                'meta_title'=>'',
                'meta_description'=>'',
                'meta_metakeywords'=>'',
                'is_featured'=>'Yes',
                'status'=>1
            ],
        ];
        Product::insert($productRecords);
    }
}
