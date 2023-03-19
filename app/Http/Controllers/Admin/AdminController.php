<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Country;
use App\Models\Vendor;
use App\Models\VendorsBankDetail;
use App\Models\VendorsBusinessDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Image;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    //Dashboard
    public function dashboard(){

        //for nav item acitve color
        Session::put('page', 'dashboard');

        return view('admin.dashboard');
    }


    //Update Admin Password
    public function updateAdminPassword(Request $request){
         //for nav item acitve color
         Session::put('page', 'update_admin_password');

        if($request->isMethod('post')){
            $data = $request->all();

            //Check if current password entered by admin is correct
            if(Hash::check($data['current_password'], Auth::guard('admin')->user()->password)){
              //Check if new password is not maching with the comfirm password
              if($data['current_password']==$data['new_password']){
                return redirect()->back()->with('error_message', 'New Password does not matches with Current Password you provide. Pls try again!');
              }else if($data['confirm_password']==$data['new_password']){
                Admin::where('id', Auth::guard('admin')->user()->id)->update(['password'=>bcrypt($data['new_password'])]);
                return redirect()->back()->with('success_message', 'Password has been updated sucessfully!');
              }
              else{
                return redirect()->back()->with('error_message', 'New Password and Confirm Password is not match');
              }

            }else{
                return redirect()->back()->with('error_message', 'Current Password is Incorrect!');
            }
        }

        //dd(Auth::guard('admin')->user());
        $adminDetails = Admin::where('email', Auth::guard('admin')->user()->email)->first()->toArray();
        return view('admin.settings.update_admin_password')->with(compact('adminDetails'));
    }

    //Check current admin password
    public function checkAdminPassword(Request $request){
        $data=$request->all();
        if(Hash::check($data['current_password'], Auth::guard('admin')->user()->password)){
           return 'true';
        }else{
            return 'false';
        }

    }

    //Update Admin Detail
    public function updateAdminDetails(Request $request){
        //for nav item acitve color
        Session::put('page', 'update_admin_details');

        if($request->isMethod('post')){
            $data=$request->all();

            $rules = [
                'name' => 'required|regex:/^[\pL\s\-]+$/u',
                'admin_mobile'=>'required|numeric',
            ];

            $customMessage = [
                'name.required' => 'Name is Required!',
                'name.regex' => 'Name is not allow Special Charater & Numerice!',
                'admin_mobile.numeric' => 'Mobile Number is allow numerice'

            ];


            $this->validate($request, $rules, $customMessage);

            //upload photo

            // if(isset($request->file) && $request->file!= null){
            //     $request->file->move(public_path('img'), $request->file->getClientOriginalName());
            // }

            if($request->hasFile('admin_image')){
                $image_tmp = $request->file('admin_image');
                if($image_tmp->isValid()){
                    //get image extension
                    $extension = $image_tmp->getClientOriginalExtension();

                    //Generate new Image name
                    $imageName=rand(111,99999).'.'.$extension;
                    //image path
                    $imagePath='admin/images/photos/'.$imageName;
                    //upload image
                    Image::make($image_tmp)->save($imagePath);
                }
            }else if(!empty($data['current_image'])){
                $imageName=$data['current_image'];
            }else{
                $imageName='';
            }


            //Update Admin Detial
            Admin::where('id', Auth::guard('admin')->user()->id)->update(['name'=>$data['name'], 'mobile'=>$data['admin_mobile'], 'image'=>$imageName]);
            return redirect()->back()->with('success_message', 'Admin Details Updated Sucessfully! ');

        }
        // $adminDetails=Admin::where('email', Auth::guard('admin')->user()->email)->first();
        return view('admin.settings.update_admin_details');


    }

    // Update Vendors Details
    public function updateVendorDetails($slug, Request $request){


        if($slug=='personal'){
            //for nav-item acitve color
            Session::put('page', 'update_vendor_personal');

            if($request->isMethod('post')){
                $data=$request->all();

                $rules = [
                    'vendor_name' => 'required|regex:/^[\pL\s\-]+$/u',
                    'vendor_mobile'=>'required|numeric',
                ];

                $customMessage = [
                    'vendor_name.required' => 'Name is Required!',
                    'vendor_name.regex' => 'Name is not allow Special Charater & Numerice!',
                    'vendor_mobile.numeric' => 'Mobile Number is allow numerice'

                ];

                if($request->hasFile('vendor_image')){
                    $image_tmp=$request->file('vendor_image');
                    if($image_tmp->isValid()){
                        $extension = $image_tmp->getClientOriginalExtension();
                        $imageName = rand(1111, 99999).'.'.$extension;
                        $imaage_path= 'admin/images/photos/'.$imageName;
                        Image::make($image_tmp)->save($imaage_path);
                    }
                }
                else if(!empty($data['current_vendor_image'])){
                    $imageName=$data['current_vendor_image'];
                }
                else{
                    $imageName='';
                }

                $this->validate($request, $rules, $customMessage);

                  //Update Admin table
                Admin::where('id', Auth::guard('admin')->user()->id)->update(['name'=>$data['vendor_name'], 'mobile'=>$data['vendor_mobile'], 'image'=>$imageName]);

                //Update Vendor table
                Vendor::where('id', Auth::guard('admin')->user()->vendor_id)->update(['email'=>$data['vendor_email'], 'name'=>$data['vendor_name'], 'mobile'=>$data['vendor_mobile'],
                'address'=>$data['vendor_address'], 'city'=>$data['vendor_city'], 'state'=>$data['vendor_state'], 'country'=>$data['vendor_country'],
                'pincode'=>$data['vendor_pincode'],
                ]);
                return redirect()->back()->with('success_message', 'Vendor Details Updated Sucessfully! ');


            }
            $vendorDetails = Vendor::where('id', Auth::guard('admin')->user()->vendor_id)->first()->toArray();
        }

        //Vendero Business Detail
        else if($slug=='business'){

             //for nav-item acitve color
             Session::put('page', 'update_vendor_business');

            if($request->isMethod('post')){
                $data=$request->all();

                $rules = [
                    'shop_name' => 'required|regex:/^[\pL\s\-]+$/u',
                    'shop_city' => 'required|regex:/^[\pL\s\-]+$/u',
                    'shop_mobile'=>'required|numeric',
                    'address_proof'=>'required',
                    // 'address_proof_image'=>'required|image',
                ];

                $customMessage = [
                    'shop_name.required' => 'Shop Name is Required!',
                    'shop_name.regex' => 'Name is not allow Special Charater & Numerice!',
                    'shop_city.regex' => 'Name is not allow Special Charater & Numerice!',
                    'shop_city.required' => 'Name is Required!',
                    'shop_mobile.numeric' => 'Mobile Number is allow numerice',
                    'address_proof.required' => 'Address Proof is Required',
                    // 'address_proof_image.required' => 'Address Proof Image is Required'

                ];

                if($request->hasFile('address_proof_image')){


                    $image_tmp=$request->file('address_proof_image');
                    if($image_tmp->isValid()){
                        $extension = $image_tmp->getClientOriginalExtension();
                        $imageName = rand(1111, 99999).'.'.$extension;
                        $image_path= 'admin/images/proofs/'.$imageName;
                         Image::make($image_tmp)->save($image_path);
                    }

                }
                else if(!empty($data['address_proof_image'])){
                    $imageName=$data['address_proof_image'];
                }
                else{
                    $imageName='';
                }
                //delete Image-----
                $vendorDetails=VendorsBusinessDetail::first();
                    if(!empty($vendorDetails['address_proof_image'])){
                        $oldImagePath = 'admin/images/proofs/'. $vendorDetails->address_proof_image;
                        unlink($oldImagePath);
                    }

                $this->validate($request, $rules, $customMessage);



                  //Update Admin table
                // Admin::where('id', Auth::guard('admin')->user()->id)->update(['name'=>$data['vendor_name'], 'mobile'=>$data['vendor_mobile'], 'image'=>$imageName]);

                //Update Vendor business detail table
                VendorsBusinessDetail::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->update(['shop_name'=>$data['shop_name'],
                'shop_address'=>$data['shop_address'], 'shop_city'=>$data['shop_city'], 'shop_state'=>$data['shop_state'], 'shop_country'=>$data['shop_country'],
                'shop_pincode'=>$data['shop_pincode'], 'shop_mobile'=>$data['shop_mobile'], 'shop_website'=>$data['shop_website'], 'shop_email'=>$data['shop_email'],
                'address_proof'=>$data['address_proof'], 'address_proof_image'=>$imageName, 'business_license_number'=>$data['business_license_number'],
                'gst_number'=>$data['gst_number'], 'pan_number'=>$data['pan_number']
                ]);
                return redirect()->back()->with('success_message', 'Vendor Details Updated Sucessfully! ');


            }
            $vendorDetails = VendorsBusinessDetail::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->first()->toArray();
            // dd($vendorDetails);

        }else if($slug=='bank'){

             //for nav-item acitve color
             Session::put('page', 'update_vendor_bank');

            if($request->isMethod('post')){
                $data=$request->all();

                $rules = [
                    'account_holder_name' => 'required|regex:/^[\pL\s\-]+$/u',
                    'bank_name' => 'required|regex:/^[\pL\s\-]+$/u',
                    'account_number'=> 'required',
                    'bank_ifsc_code'=>'required'
                ];

                $customMessage = [
                    'account_holder_name.required' => 'Account Holder Name is Required!',
                    'account_holder_name.regex' => 'Account Holder Name is not allow Special Charater & Numerice!',
                    'bank_name.regex' => 'Bank Name is not allow Special Charater & Numerice!',
                    'bank_name.required' => 'Bank Name is Required!',
                    'account_number.required'=>'Account Number is Required!',
                    'bank_ifsc_code.required'=>'Account ifsc Number is Required!'
                ];


                $this->validate($request, $rules, $customMessage);



                  //Update Admin table
                // Admin::where('id', Auth::guard('admin')->user()->id)->update(['name'=>$data['vendor_name'], 'mobile'=>$data['vendor_mobile'], 'image'=>$imageName]);

                //Update Vendor business detail table
                VendorsBankDetail::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->update(['account_holder_name'=>$data['account_holder_name'],
                'bank_name'=>$data['bank_name'], 'account_number'=>$data['account_number'], 'bank_ifsc_code'=>$data['bank_ifsc_code'],
            ]);
                return redirect()->back()->with('success_message', 'Vendor Details Updated Sucessfully! ');


            }
            $vendorDetails = VendorsBankDetail::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->first()->toArray();

        }
        else{
            return view('admin.404');
        }

        $countries=Country::where('status', 1)->get();

        return view('admin.settings.update_vendor_details')->with(compact('slug', 'vendorDetails', 'countries'));

    }

    //View Admin
    public function admins($type=null){

        $admins=Admin::query();
       if(!empty($type)){
            $admins=$admins->where('type', $type);
            //ucfirst helper method is used to uppercase the first letter of a staring.
            $title=ucfirst($type);

             //for nav-item acitve color
            Session::put('page', 'view_'.strtolower($title));
        }
        else{
            $title="All Admins/Subadmins/vendors";

            //for nav-item acitve color
            Session::put('page', 'view_all');
        }

        $admins=$admins->get()->toArray();
        return view('admin.admins.admins')->with(compact('admins', 'title'));

    }

    //Vendors View
    public function viewVendorDetails($id) {
        $vendorDetails = Admin::with('vendorPersonal', 'vendorBusiness', 'vendorBank')->where('id', $id)->first();
        // $vendorDetails = json_decode(json_encode($vendorDetails), true);
        $vendorDetails = json_decode($vendorDetails, true);
        return view('admin.admins.view_vendor_details')->with(compact('vendorDetails'));

    }

    //Update Admin Stats
    public function updateAdminStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
            //echo"<pre>"; print_r($data); die;
            if($data['status']=="Active"){
                $status = 0;

            }else{
                $status = 1;
            }
            //echo "<pre>"; print_r($status); die;
            Admin::where('id', $data['admin_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status, 'admin_id'=>$data['admin_id']]);
        }
        // $data=$request->all();
        // dd($data);

    }

    //Admin login
    public function login(Request $request){
        //echo $password = Hash::make('12345678'); die;
        if($request->isMethod('post')){
            $data = $request->all();
            // dd($data);

           $rules = [
            'email'=> 'required|email|max:255',
            'password' => 'required',
           ];


           //Custom Message for validate
           $customMessage =[
            'email.required'=> 'Email is Required!',
            'email.email' => 'Valid Email Address is Required',
            'password.required'=>'Password is Required!',
           ];
           $this->validate($request, $rules, $customMessage);

            if(Auth::guard('admin')->attempt(['email'=>$data['email'], 'password'=>$data['password']])){
                return redirect('admin/dashboard');
            }
            else{

                return redirect()->back()->with('error_message', 'Invalid Email or Password');

            };
        }

        return view('admin.login');
    }
    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }

}
