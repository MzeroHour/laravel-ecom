<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Random\Engine\Secure;

class SectionController extends Controller
{
    //
    public function sections(){

        //for nav-item acitve color
        Session::put('page', 'sections');

        $sections=Section::get()->toArray();
        return view('admin.sections.sections')->with(compact('sections'));
    }

    //Update Section status with ajax
    public function updateSectionStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
            // echo "Data"; print_r($data); die;
            if($data['status']=='Active'){
                $status=0;
            }else{
                $status=1;
            }
            Section::where('id', $data['section_id'])->update(['status'=>$status]);
            return response( )->json(['status'=>$status, 'section_id'=>$data['section_id']]);
        }
    }

    //Delete Section with ajax
    public function deleteSection($id){
        Section::where('id', $id)->delete();
        return response()->json(['success']);
        // $message="Section has been Deleted Succefully!";
        // return redirect()->back()->with('success_message', $message);
    }

    //add and edit section
    public function addEditSection(Request $request, $id=null){
        if($id==''){
            //Add Section Funcionally
            $title="Add Section";
            $section= new Section;
            $message = "Section Added New";
        }else{
            //Edit Section Funcionally
            $title="Edit Section";
            $section= Section::find($id);
            $message= 'Section Updated Sucessfuly';
        }

        if($request->isMethod('post')){
            $data= $request->all();
            $rules = [
                'section_name' => 'required|regex:/^[\pL\s\-]+$/u',
            ];
            $customMessage = [
                'section_name.required' => 'Name is Required!',
                'section_name.regex' => 'Name is not allow Special Charater & Numerice!',

            ];
            $this->validate($request, $rules, $customMessage);

            $section->name = $data['section_name'];
            $section->status = 1;
            $section->save();
            //echo"<pre>"; print_r($data); die;
            return redirect('admin/sections?')->with('success_message', $message);
        }
        return view('admin.sections.add_edit_section')->with(compact('title', 'section', 'message'));
    }
}
