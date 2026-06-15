<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use Illuminate\Http\Request;

class SubmissionController extends Controller
{

    public function index(){
        $submissions=Submission::paginate(10);
        return view('admin.pannel',['submissions'=>$submissions,'users'=>null,'search'=>false,"categories"=>null]);
    }


    public function show($id){
        $submission=Submission::find($id);
        return view('submission.show',['submission'=>$submission]);
    }

    public function accept($id){
        $submission=Submission::find($id);
        if($submission){

            $submission->user()->update(["is_writer"=>true,"first_name"=>$submission->first_name,"last_name"=>$submission->last_name]);
            $submission->delete();
            return redirect()->route('admin.pannel')->with('success','Demande accepté');
        }
        return redirect('dashboard')->with('error','Demande pas trouvé');
    }

    public function reject($id){
        $submission=Submission::find($id);
        if($submission){
            $submission->delete();
            return redirect()->route('admin.pannel')->with('success','Demande rejetée');
        }
        return redirect('dashboard')->with('error','Demande pas trouvé');
    
    }
}
