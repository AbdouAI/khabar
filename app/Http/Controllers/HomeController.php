<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $categories=Category::all();
        $today = Carbon::today()->toDateString();

        $todayArticles = Article::whereDate('date', $today)
                        ->orderBy('date', 'desc')
                        ->limit(5)
                        ->get();

        $viewArticles = Article::orderBy('view_count', 'desc')->limit(8)->get();

        $sevenDaysAgo = Carbon::today()->subDays(7);
        $weekTitles = Article::whereBetween('date', [$sevenDaysAgo, $today])
                        ->orderBy('view_count', 'desc')
                        ->limit(10)
                        ->get();


        $ecocat=Category::where('name','economie')->first();
        $economieArticles = Article::where('category_id', $ecocat->id) 
        ->orderBy('view_count', 'desc')
        ->limit(7)
        ->get();

        $spocat=Category::where('name','sport')->first();
        $sportArticles = Article::where('category_id', $spocat->id) 
                            ->orderBy('view_count', 'desc')
                            ->limit(7)
                            ->get();
        
        $polcat=Category::where('name','politique')->first();
        $politiqueArticles = Article::where('category_id',$polcat->id) 
                            ->orderBy('view_count', 'desc')
                            ->limit(7)
                            ->get();

        return view('dashboard',compact('categories','todayArticles','weekTitles','politiqueArticles','sportArticles','economieArticles','viewArticles'));
    }
}
