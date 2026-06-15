<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CommentController extends Controller
{
    public function store(Request $request,$article_id){
        $request->validate([
            'comment_text'=>'required|min:50|max:1000',
            'name'=>'required|min:10|max:60',
            'email'=>'required|email',
        ]);

        Comment::create([
            'comment_text'=>$request->comment_text,
            'name'=>$request->name,
            'email'=>$request->email,
            'article_id'=>$article_id,
            'date_time'=>Carbon::now(),
        ]);
        return back()->with('success','Commentaire ajouté');
    }

    public function vote($article_id,$comment_id,$vote){
        $votes=session('votes');
        if(!$votes||!array_key_exists($comment_id,$votes)){
            $comment=Comment::findOrFail($comment_id);
                $vote=='like'?$comment->increment('like_count'):$comment->increment('dislike_count');
                $votes[$comment_id]=$vote;
                Session::put('votes',$votes);
                return back();
        }else{
            return response()->json(['error' => 'You have already liked or disliked this post.'], 409);
        }
            
        
        
    }

}
