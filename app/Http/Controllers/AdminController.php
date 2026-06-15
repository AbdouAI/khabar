<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Submission;
use App\Models\User;
use Illuminate\Http\Request;

use function Laravel\Prompts\search;

class AdminController extends Controller
{
    public function pannel(){
        return redirect()->route('submission.index');
    }

    public function articles(){
        return view('admin.pannel',['submissions'=>null,'users'=>null,'search'=>true,'categories'=>null]);
    }

    public function search(Request $request){
        $request->validate([
            'term'=>'required',
        ]);

        $term=$request->term;
        $result = Article::where('title', 'like', '%' . $term . '%')
        ->orWhereHas('category', function ($query) use ($term) {
            $query->where('name', 'like', '%' . $term . '%');
        })->orderBy('date','desc')->paginate(7);

        $result->appends(['term'=>$term]);

        return view('admin.pannel',['submissions'=>null,'users'=>null,'result'=>$result,'search'=>true,'categories'=>null]);
    }
}
