<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Image;


class BannerController extends Controller
{
    //
    public function banners(){
        Session::put('page', 'banners');
        $banners = Banner::get()->toArray();
        return view('admin.banners.banners')->with(compact('banners'));

    }
    public function updateBannerStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();

            if($data['status']=="Active"){
                $status = 0;
            }else{
                $status =1;
            }
            Banner::where('id', $data['banner_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status, 'banner_id'=>$data['banner_id']]);
        }

    }
    public function deleteBanner($id){
        //delete Image-----
        $bannerDeleteImage=Banner::where('id', $id)->first();
        if(!empty($bannerDeleteImage['image'])){
            $oldImagePath = 'admin/images/banners/'.$bannerDeleteImage->image;
            @unlink($oldImagePath);
        }

     Banner::where('id', $id)->delete();

     return response()->json(['success']);
    }

    public function addEditBanner(Request $request, $id=null){
        if($id==""){
             //Add Banner Functionally
            $title = "Add Banner";
            $banner = new Banner;
            $message="Banner has been Added Successfully!";
        }else{
            //Edit Banner Functionally
            $title="Edit Banner";
            $banner=Banner::find($id);
            $message = "Banner has been Updated Sucesssfully!";
        }

        //Edit banner
        if($request->isMethod('post')){
            $data = $request->all();

            $rules = [
                'banner_title' => 'required|regex:/^[\pL\s\-]+$/u',
                'banner_link'=> 'required',
            ];
            $customMessage = [
                'banner_title.required' => 'Banner Title is Required!',
                'banner_title.regex' => 'Banner Title is not allow Special Charater & Numerice!',
                'banner_link.required' => 'Banner Url is Required',
            ];
            $this->validate($request, $rules, $customMessage);

            $banner->title = $data ['banner_title'];
            $banner->link = $data ['banner_link'];
            $banner->alt = $data['banner_alt'];
            $banner->status = 1;

            //Upload Banner Image
            if($request->hasFile('banner_image')){
                $image_tmp=$request->file('banner_image');
                if($image_tmp->isValid()){
                    $extension = $image_tmp->getClientOriginalExtension();
                    $imageName = rand(1111, 99999).'.'.$extension;
                    $imaage_path= 'admin/images/banners/'.$imageName;
                    Image::make($image_tmp)->resize(1920, 720)->save($imaage_path);

                    $banner->image=$imageName;
                }
            }
            // else{
            //     $banner->image = '';
            // }

             $banner->save();

             return redirect('admin/banners')->with('success_message', $message);
        }

        return view('admin.banners.add_edit_banner')->with(compact('banner', 'title'));
    }

}
