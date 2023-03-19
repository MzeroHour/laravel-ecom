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

    //Add and Edit Brand
    public function addEditBrand(Request $request, $id=null){
        if($id==''){
            //Add New Brand Functionally
            $title= "Add New Brand";
            $brand= new Brand();
            $message='Brand Add New';
        }else{
            //Edit Brand Functionally
            $title="Edit Brand";
            $brand=Brand::find($id);
            $message='Brand Updated Sucessfuly';


        }
        if($request->isMethod('post')){
            $data=$request->all();
            $rules = [
                'brand_name' => 'required|regex:/^[\pL\s\-]+$/u',
            ];
            $customMessage = [
                'brand_name.required' => 'Name is Required!',
                'brand_name.regex' => 'Name is not allow Special Charater & Numerice!',

            ];
            $this->validate($request, $rules, $customMessage);


            $brand->name = $data['brand_name'];
            $brand->status = 1;
            $brand->save();

            return redirect('admin/brands?')->with('success_message', $message);

        }
        return view('admin.brands.add_edit_brand')->with(compact('title', 'brand', 'message'));
    }
}


