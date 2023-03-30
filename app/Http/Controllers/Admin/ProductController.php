<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductsAttribute;
use App\Models\Section;
use Illuminate\Http\Request;
use Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    //
    public function products()
    {

        //for nav item acitve color
        Session::put('page', 'products');

        $products = Product::with(['section' => function ($query) {
            $query->select(['id', 'name']);
        }, 'category' => function ($query) {
            $query->select(['id', 'category_name']);
        }])->get()->toArray();
        //return $products;
        return view('admin.products.products')->with(compact('products'));
    }

    //Update Product Status
    public function updateProductStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }
            Product::where('id', $data['product_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'product_id' => $data['product_id']]);
        }
    }

    //Delete Product with ajax
    public function deleteProduct($id)
    {
        //delete Image-----
        $productDeleteImageVideo = Product::where('id', $id)->first();
        if (!empty($productDeleteImageVideo['product_image'])) {
            $oldImagePath = 'admin/images/products/' . $productDeleteImageVideo->product_image;
            @unlink($oldImagePath);
        }
        //dd($productDeleteImageVideo);

        //Delete Video
        if (!empty($productDeleteImageVideo['product_video'])) {
            $oldVideoPath = 'admin/video/products/' . $productDeleteImageVideo->product_video;
            @unlink($oldVideoPath);
        }

        Product::where('id', $id)->delete();

        return response()->json(['success']);
        //return redirect()->back()->with('sucess_message', $message);
    }

    //Add and Update
    public function addEditProdcut(Request $request, $id = null)
    {
        //for nav item acitve color
        Session::put('page', 'products');

        if ($id == null) {
            $title = "Add Product";
            $product = new Product;
            $message = "Prodcut added Successfully";
        } else {
            $title = "Update Product";
            $product = Product::find($id);
            $message = " Porduct is Updated Successfully";
        }
        if ($request->isMethod('post')) {
            $data = $request->all();
            //dd ($data);

            $rule = [
                'product_name' => 'required|regex:/^[\pL\s\-]+$/u',
                'category_id' => 'required',
                'product_code' => 'required|regex:/^\w+$/',
                'product_price' => 'required|numeric',
                'product_color' => 'required|regex:/^[\pL\s\-]+$/u',

            ];
            $customMessage = [
                'product_name.required' => 'Product is Required',
                'product_name.regex' => 'Valid Product Name is Required',
                'category_id.required' => 'Category is Required',
                'product_code.required' => 'Product Code is Required',
                'product_code.regex' => 'Valid Prodcut Code is Required',
                'product_price.required' => 'Product Price is Required',
                'product_price.regex' => 'Valid Product Price is Required',
                'product_color.required' => 'Product Color is Required',
                'product_color.regex' => 'Valid Product Color is Required'
            ];
            $this->validate($request, $rule, $customMessage);

            //Upload Product Image after Resize --- Small : 250 x 250 --- Medium : 500 x 500 --- Large : 1000 x 1000
            if ($request->hasFile('product_image')) {
                $image_tmp = $request->file('product_image');
                if ($image_tmp->isValid()) {
                    //Get image Extendion
                    $extendion = $image_tmp->getClientOriginalExtension();
                    $imageName = rand(1111, 9999) . '.' . $extendion;
                    $largeImagePath = 'admin/images/products/large/' . $imageName;
                    $mediumImagePath = 'admin/images/products/medium/' . $imageName;
                    $smallImagePath = 'admin/images/products/small/' . $imageName;


                    //Upload the Image
                    Image::make($image_tmp)->resize(1000, 1000)->save($largeImagePath);
                    Image::make($image_tmp)->resize(500, 500)->save($mediumImagePath);
                    Image::make($image_tmp)->resize(250, 250)->save($smallImagePath);

                    //Insert Image Name in product table
                    $product->product_image = $imageName;
                }
            }

            if (request()->hasFile('product_video')) {
                $video_temp = $request->file('product_video');
                if ($video_temp->isValid()) {
                    //Get video Extendion

                    $extendion = $video_temp->getClientOriginalExtension();
                    $videoName = rand(1111, 9999) . '.' . $extendion;
                    $videoPath = 'admin/video/products/';
                    $video_temp->move($videoPath, $videoName);

                    //Insert Video in Product table
                    $product->product_video = $videoName;



                    //Upload Video

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

            if ($adminType == "vendor") {
                $product->vendor_id = $vendor_id;
            } else {
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
            $product->meta_keywords = $data['meta_keywords'];

            if (!empty($data['is_featured'])) {
                $product->is_featured = $data['is_featured'];
            } else {
                $product->is_featured = "No";
            }
            $product->status = 1;
            $product->save();

            return redirect('admin/products')->with('success_message', $message);
        }



        //Get Section with Categories and Sub Categories
        $categories = Section::with('categories')->get()->toArray();

        //Get all Brands Name
        $brands = Brand::where('status', 1)->get()->toArray();
        //dd ($categories);
        return view('admin.products.add_edit_product')->with(compact('title', 'categories', 'brands', 'product'));
    }

    //Delete Product Image
    public function deleteProductImage($id)
    {
        //Get Product Image
        $productImage = Product::select('product_image')->where('id', $id)->first();

        //Get Product Image Path
        $smallImagePath = 'admin/images/products/small/';
        $mediumImagePath = 'admin/images/products/medium/';
        $largeImagePath = 'admin/images/products/large/';

        //Delete Product Image
        if (file_exists($smallImagePath . $productImage->product_image)) {
            unlink($smallImagePath . $productImage->product_image);
        }
        if (file_exists($mediumImagePath . $productImage->product_image)) {
            unlink($mediumImagePath . $productImage->product_image);
        }
        if (file_exists($largeImagePath . $productImage->product_image)) {
            unlink($largeImagePath . $productImage->product_image);
        }

        //Delete Product Image from product table
        Product::where('id', $id)->update(['product_image' => '']);

        $message = "Product Image has been deleted Successfully";


        //return response()->json(['success_message' => $message]);
        return redirect()->back()->with('success_message', $message);
        // dd(session()->all());
    }


    // Delete Product Video

    public function deleteProductVideo($id)
    {
        $productVideo = Product::select('product_video')->where('id', $id)->first();

        //get path
        $path_video = 'admin/video/products/';

        //Delete Product Video in folder if exists
        if (file_exists($path_video . $productVideo->product_video)) {
            unlink($path_video . $productVideo->product_video);
        }

        //Delete Product Video from product table
        Product::where('id', $id)->update(['product_video' => '']);

        $message = "Product Video has been deleted Successfully";


        //return response()->json(['success_message' => $message]);
        return redirect()->back()->with('success_message', $message);
    }

    //Product Attributes
    public function addAttributes(Request $request, $id)
    {
        //for nav item acitve color
        Session::put('page', 'products');

        $title = "Products";
        $product  = Product::select('id', 'product_name', 'product_code', 'product_color', 'product_price', 'product_image')->with('attributes')->find($id);
        $product = json_decode($product, true);
        // dd ($product);
        if ($request->isMethod('post')) {
            $data = $request->all();

            foreach ($data['sku'] as $key => $value) {
                if (!empty($value)) {

                    //SKU duplicate Check
                    $skuCount = ProductsAttribute::where('sku', $value)->count();
                    if ($skuCount > 0) {
                        return redirect()->back()->with('error_message', 'SKU already exists! Please add another SKU');
                    }

                    //Size duplicate Check
                    $sizeCount = ProductsAttribute::where(['product_id' => $id, 'size' => $data['size'][$key]])->count();
                    if ($sizeCount > 0) {
                        return redirect()->back()->with('error_message', 'Size already exists! Please add another Size');
                    }

                    $attribute = new ProductsAttribute;
                    $attribute->product_id = $id;
                    $attribute->sku = $value;
                    $attribute->size = $data['size'][$key];
                    $attribute->price = $data['price'][$key];
                    $attribute->stock = $data['stock'][$key];
                    $attribute->status = 1;
                    $attribute->save();
                }
            }
            return redirect()->back()->with('success_message', 'Product Attributes has been added successfully');
        }
        $product = Product::find($id);
        return view('admin.attributes.add_edit_attributes')->with(compact('product', 'title'));
    }

    //update attribute status
    public function updateAttributeStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }
            ProductsAttribute::where('id', $data['attribute_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'attribute_id' => $data['attribute_id']]);
        }
    }

    //Update attribute
    public function editAttribute(Request $request, $id)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

            foreach ($data['attributeId'] as $key => $attribute) {
                if (!empty($attribute)) {
                    ProductsAttribute::where(['id' => $data['attributeId'][$key]])
                        ->update(['price' => $data['price'][$key], 'stock' => $data['stock'][$key]]);
                }
            }
            return redirect()->back()->with('success_message', 'Product Attributes has been Updated Successfully');
        }
    }

    //Delete Attribue
    public function deleteAttribute($id){
        ProductsAttribute::where('id', $id)->delete();
        //return redirect()->back()->with('sucess_message', $message);
        return response()->json(['success']);
    }
}
