<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Image;

class CategoryController extends Controller
{
    //
    public function categories(){

        //for nav item acitve color
        Session::put('page', 'categories');

        $categories = Category::with(['section', 'parent'])->get()->toArray();
        // dd($categories); die;
        return view('admin.categories.categories')->with(compact('categories'));
    }
    public function updateCategoryStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();

            if($data['status']=="Active"){
                $status=0;
            }else{
                $status=1;
            }
            Category::where('id', $data['category_id'])->update(['status'=>$status]);
            return response( )->json(['status'=>$status, 'category_id'=>$data['category_id']]);
        }
    }
    public function addEditCategory(Request $request, $id=null){
        if($id==""){
            //Add Category Funcionally
            $title= "Add Category";
            $category= new Category;
            $getCategories = array();
            $message="Category Added Successfully!";
        }
        else{
            //Edit Category Funcionally
            $title="Update Category";
            $category=Category::find($id);
            $getCategories=Category::with('subcategories')->where(['parent_id'=>0, 'section_id'=>$category['section_id']])->get()->toArray();
            $message="Updated Category Successfully!";

            //dd($getCategories); die;
        }

        if($request->isMethod('post')){
            $data=$request->all();

            $rules = [
                'category_name' => 'required|regex:/^[\pL\s\-]+$/u',
                'section_id'=> 'required',
                'category_url'=> 'required',
            ];
            $customMessage = [
                'category_name.required' => 'Category Name is Required!',
                'category_name.regex' => 'Category Name is not allow Special Charater & Numerice!',
                'section_id.required' => 'Section is Required',
                'category_url.required' => 'Category Url is Required',
            ];
            $this->validate($request, $rules, $customMessage);

            //Upload Category Image
            if($request->hasFile('category_image')){
                $image_tmp=$request->file('category_image');
                if($image_tmp->isValid()){
                    $extension = $image_tmp->getClientOriginalExtension();
                    $imageName = rand(1111, 99999).'.'.$extension;
                    $imaage_path= 'admin/images/categories/'.$imageName;
                    Image::make($image_tmp)->save($imaage_path);
                    $category->category_image=$imageName;
                }
            }
            else{
                $category->category_image='';
            }

             //delete Image-----
             $categoryDeleteImage=Category::where('id', $id)->first();
             if(!empty($categoryDeleteImage['category_image'])){
                 $oldImagePath = 'admin/images/categories/'.$categoryDeleteImage->category_image;
                 @unlink($oldImagePath);
             }
             //dd($categoryDeleteImage);

            $category->category_name=$data['category_name'];
            $category->section_id=$data['section_id'];
            $category->parent_id=$data['parent_id'];
            $category->category_discount=$data['category_discount'];
            $category->description=$data['description'];
            $category->url=$data['category_url'];
            $category->meta_title=$data['meta_title'];
            $category->meta_description=$data['meta_description'];
            $category->meta_keywords=$data['meta_keywords'];
            $category->status=1;
            $category->save();

            // dd($category); die;
            return redirect('admin/categories')->with('success_message', $message);
        }
         // Get Section
         $getSection=Section::get()->toArray();

        return view('admin.categories.add_edit_category')->with(compact('title', 'category','getSection', 'getCategories'));
    }
    //Ajax Category Select box
    public function appendCategoryLevel(Request $request){
        if($request->ajax()){
            $data=$request->all();
            $getCategories=Category::with('subcategories')->where(['parent_id'=>0, 'section_id'=>$data['section_id']])->get()->toArray();
            return view('admin.categories.append_category_level')->with(compact('getCategories'));
        }
    }

    //Delete Categroy with ajax
    public function deleteCategory($id){
           //delete Image-----
           $categoryDeleteImage=Category::where('id', $id)->first();
           if(!empty($categoryDeleteImage['category_image'])){
               $oldImagePath = 'admin/images/categories/'.$categoryDeleteImage->category_image;
               @unlink($oldImagePath);
           }
           //dd($categoryDeleteImage);

        Category::where('id', $id)->delete();

        return response()->json(['success']);
        //return redirect()->back()->with('sucess_message', $message);

    }
}
