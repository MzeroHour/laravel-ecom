<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function products(){
        $products=Product::get()->toArray();
        //return $products;
        return view('admin.products.products')->with(compact('products'));
    }

    //Update Product Status
    public function updateProductStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
            if($data['status']=="Active"){
                $status=0;
            }else{
                $status=1;
            }
            Product::where('id', $data['product_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status, 'product_id'=>$data['product_id']]);
        }
    }

     //Delete Product with ajax
     public function deleteProduct($id){
        //delete Image-----
           $productDeleteImage=Product::where('id', $id)->first();
           if(!empty($productDeleteImage['product_image'])){
               $oldImagePath = 'admin/images/products/'.$productDeleteImage->product_image;
               @unlink($oldImagePath);
           }
           //dd($categoryDeleteImage);

         Product::where('id', $id)->delete();

        return response()->json(['success']);
        //return redirect()->back()->with('sucess_message', $message);
    }

}
