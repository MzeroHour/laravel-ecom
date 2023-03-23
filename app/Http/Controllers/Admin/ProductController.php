<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Section;
use Illuminate\Http\Request;
use Image;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    //
    public function products(){
        $products=Product::with(['section'=>function($query){
            $query->select(['id', 'name']);
        }, 'category'=>function($query){
            $query->select(['id', 'category_name']);
        }])->get()->toArray();
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

    //Add and Update
    public function addEditProdcut(Request $request, $id=null){
        if($id==null){
            $title="Add Product";
            $product = new Product ;
            $message = "Prodcut added Successfully";
        }else{
            $title="Update Product";
            $product = Product::find($id);
            $message= " Porduct is Updated Successfully";
        }
        if($request->isMethod('post')){
            $data = $request->all();
            //dd ($data);

            $rule = [
                'product_name' => 'required|regex:/^[\pL\s\-]+$/u',
                'category_id' => 'required',
                'product_code'=> 'required|regex:/^\w+$/',
                'product_price' => 'required|numeric',
                'product_color' => 'required|regex:/^[\pL\s\-]+$/u',

            ];
            $customMessage = [
                'product_name.required' => 'Product is Required',
                'product_name.regex'=> 'Valid Product Name is Required',
                'category_id.required' => 'Category is Required',
                'product_code.required' => 'Product Code is Required',
                'product_code.regex'=> 'Valid Prodcut Code is Required',
                'product_price.required' => 'Product Price is Required',
                'product_price.regex' => 'Valid Product Price is Required',
                'product_color.required' => 'Product Color is Required',
                'product_color.regex' => 'Valid Product Color is Required'
            ];
            $this->validate($request, $rule, $customMessage);

            //Upload Product Image after Resize
            //Small : 250 x 250
            //Medium : 500 x 500
            //Large : 1000 x 1000

            if($request->hasFile('product_image')){
                $image_tmp = $request->file('product_image');
                if($image_tmp->isValid()){
                    //Get image Extendion
                    $extendion = $image_tmp->getClientOriginalExtension();
                    $imageName=rand(1111, 9999).'.'.$extendion;
                    $largeImagePath='admin/images/products/large/'.$imageName;
                    $mediumImagePath='admin/images/products/medium/'.$imageName;
                    $smallImagePath='admin/images/products/small/'.$imageName;


                    //Upload the Image
                    Image::make($image_tmp)->resize(1000, 1000)->save($largeImagePath);
                    Image::make($image_tmp)->resize(500, 500)->save($mediumImagePath);
                    Image::make($image_tmp)->resize(250, 250)->save($smallImagePath);

                    //Insert Image Name in product table
                    $product->product_image = $imageName;

                }

            }



            //Save Product Details in product table
            $categoryDetail = Category::find($data['category_id']);
            $product->section_id = $categoryDetail['section_id'];
            $product->category_id = $data['category_id'];
            $product->brand_id = $data['brand_id'];

            $adminType = Auth::guard('admin')->user()->type;
            $admin_id = Auth::guard('admin')->user()->id;
            $vendor_id = Auth::guard('admin')->user()->vendor_id;

            $product->admin_type = $adminType;
            $product->admin_id = $admin_id;

            if($adminType=="vendor"){
                $product->vendor_id = $vendor_id;
            }else{
                $product->vendor_id = 0;
            }

            $product->product_name = $data['product_name'];
            $product->product_code = $data['product_code'];
            $product->product_color = $data['product_color'];
            $product->product_price = $data['product_price'];
            $product->product_discount = $data['product_discount'];
            $product->product_weight = $data['product_weight'];
            $product->description = $data['description'];
            $product->meta_title = $data['meta_title'];
            $product->meta_description = $data['meta_description'];
            $product->meta_keywords = $data ['meta_keywords'];

            if(!empty($data['is_featured'])){
                $product->is_featured = $data['is_featured'];
            }else{
                $product->is_featured = "No";
            }
            $product->status = 1;
            $product->save();

            return redirect('admin/products')->with('success_message', $message);

        }



        //Get Section with Categories and Sub Categories
        $categories=Section::with('categories')->get()->toArray();

        //Get all Brands Name
        $brands=Brand::where('status', 1)->get()->toArray();
        //dd ($categories);
       return view('admin.products.add_edit_product')->with(compact('title', 'categories', 'brands', 'product'));

    }

}
