<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable=[
        'name','email','comment_text','like_count','dislike_count','date_time','article_id'
    ];

    public function article(){
        return $this->belongsTo(Article::class);
    }
}
