<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class BrandController extends Controller
{
    //
    public function brands(){
        Session::put('page', 'brands');
        $brands = Brand::get()->toArray();
        return view('admin.brands.brands')->with(compact('brands'));
    }

    public function updateBrandStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
           //echo "Data"; print_r($data); die;

           if($data['status']=='Active'){
                $status=0;
           }
           else{
            $status=1;
        }
        Brand::where('id', $data['brand_id'])->update(['status'=> $status]);
        return response( )->json(['status'=>$status, 'brand_id'=>$data['brand_id']]);

        }
    }

   //Delete Brand with ajax
    public function deleteBrand($id){
        Brand::where('id', $id)->delete();
        return response()->json(['success']);
        // $message="Section has been Deleted Succefully!";
        // return redirect()->back()->with('success_message', $message);
    }
}


