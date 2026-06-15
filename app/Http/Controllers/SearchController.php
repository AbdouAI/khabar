<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request){
        
        $categories=Category::all();
        $request->validate([
            'term'=>'required',
        ]);
        $term=$request->term;
        $result = Article::where('title', 'like', '%' . $term . '%')
        ->orWhereHas('category', function ($query) use ($term) {
            $query->where('name', 'like', '%' . $term . '%');
        })->orderBy('date','desc')->paginate(7);

        $result->appends(['term'=>$term]);

        return view('dashboard',compact('categories','term'))->with('result',$result);
    }

    public function filtre($filtre){
        $categories=Category::all();
        if($filtre=='views'){
            $result = Article::orderBy('view_count', 'desc')->paginate(7);
        }
        elseif($filtre=='comments'){
            $result = Article::withCount('comments')
                   ->orderBy('comments_count', 'desc')
                   ->paginate(7);
        }
        elseif($filtre=='new'){
            $result = Article::orderBy('date', 'desc')
                   ->paginate(7);
        }
        elseif($filtre=='old'){
            $result = Article::orderBy('date', 'asc')
                   ->paginate(7);
        }
        elseif($filtre=='all'){
            return redirect('/');
        }
        return view('dashboard',compact('categories'))->with('result',$result);

    }
}
