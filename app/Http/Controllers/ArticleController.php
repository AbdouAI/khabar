<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function index(){
        $articles=Article::where('user_id','=',auth()->id())->paginate(7);
        return view('article.index',['articles'=>$articles]);
    }
    public function create(){
        $categories=Category::all();
        return view('article.create',compact('categories'));
    }

    public function store(Request $request){
        $request->validate([
            'title'=>'required|max:255|min:2',
            'text'=>'required|min:2',
            'image'=>'file|mimes:jpg,png',
            'category_id'=>'required',
        ]);

        $file=Storage::putFile('/public/articleImages',$request->file('image'));

        $filename=pathinfo($file)['basename'];
        Article::create([
            'title'=>$request->title,
            'text'=>$request->text,
            'date'=>Carbon::now()->format('Y-m-d'),
            'user_id'=>auth()->id(),
            'category_id'=>$request->category_id,
            'image'=>$filename,
        ]);

        return redirect()
            ->route('dashboard')
            ->with('success', 'Article jouté');
    }

    public function edit($id){
        $categories=Category::all();
        $article=Article::find($id);
        if($article){

            if(auth()->user()->id==$article->user_id){
                return view('article.edit',compact('article','categories'));
            }
            return redirect('dashboard')->with('error','Accés unauthorisé');
        }
        return redirect('dashboard')->with('error','Article pas trouvé');

        
    }

    public function update(Request $request,$id){
        $article=Article::find($id);
        if($article){
            if(auth()->user()->id==$article->user_id || auth()->user()->is_admin){
            $request->validate([
                'title'=>'required|max:255|min:2',
                'text'=>'required|min:2',
                'image'=>'file|mimes:jpg,png',
                'category_id'=>'required',

            ]);
            $filename=$article->image;
            if($request->file('image')){
                $oldFile=$article->image;
                Storage::delete('public/articleImages/'.$oldFile);
                $file=Storage::putFile('/public/articleImages',$request->file('image'));
                $filename=pathinfo($file)['basename'];
            }
        
            $article->update([
                'title'=>$request->title,
                'text'=>$request->text,
                'image'=>$filename,
                'category_id'=>$request->category_id,
            ]);

            return redirect()->back()->with('success', 'Article Modifié');
        }
        return redirect('dashboard')->with('error','Accés unauthorisé');
    }
    return redirect('dashboard')->with('error','Article pas trouvé');

    }


    public function show($id){
        $article=Article::find($id);
        if($article){
            $article->increment('view_count');
            $cat_id=$article->category->id;
            $recommend=Article::where('category_id', $cat_id)
            ->orderBy('date', 'desc') 
            ->take(10) 
            ->inRandomOrder()
            ->take(3) 
            ->get();
            return view('article.show',compact('article','recommend'));
        }
        return redirect('dashboard')->with('error','Article pas trouvé');

    }

    public function destroy($id){
        $article=Article::find($id);
        if($article){

        if(auth()->user()->id==$article->user_id || auth()->user()->is_admin){

        $oldFile=$article->image;
        Storage::delete('public/articleImages/'.$oldFile);
        $article->delete();
        return back()->with('success','Article Supprimé');
        }
        return back()->with('error','Accés unauthorisé');
        
    }
    return back()->with('error','Article pas trouvé');

    }
}
