<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        // password : 12345678 generated ->
        // $admimRecord=[
        //     ['id'=>1, 'name'=>'Super Admin', 'type'=>'superadmin', 'vendor_id'=>0, 'mobile'=> '09-425008234',
        //     'email'=>'myintzaw2010@gmail.com', 'password'=>'$2a$12$qok2bXLU33krnqnh1sKm0Oa4L49kLH4/XoyNgO.8KdTJrONZtYJhq', 'image'=>'','status'=>1],

        // ];
        $admimRecord=[
            ['id'=>2, 'name'=>'John', 'type'=>'vendor', 'vendor_id'=>1, 'mobile'=> '09-796190838',
            'email'=>'john@admin.com', 'password'=>'$2a$12$qok2bXLU33krnqnh1sKm0Oa4L49kLH4/XoyNgO.8KdTJrONZtYJhq', 'image'=>'','status'=>0],
        ];
        Admin::insert($admimRecord);
    }
}
