<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $categories=Category::paginate(10);
        foreach($categories as $cat){
            $cat->article_count=$cat->articles()->count();
        }
        return view('admin.pannel',['submissions'=>null,'users'=>null,'search'=>false,'categories'=>$categories]);
    }

    public function create(){
        return view('category.create');
    }


    public function store(Request $request){
        $request->validate([
            'name'=>'required|min:2'
        ]);
        Category::create(['name'=>$request->name]);

        return redirect()->route('category.index')->with('success','Categorie Crée');
    }



    public function destroy($id){
        $category=Category::findOrFail($id);
        $category->delete();
        return redirect()->route('category.index')->with('success','Categorie supprimé');
        
    }
}
