<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'text',
        'image',
        'date',
        'user_id',
        'category_id',
        'view_count',

    ];

    public function user():BelongsTo{
        return $this->belongsTo(User::class);
    } 

    public function category():BelongsTo{
        return $this->belongsTo(Category::class,'category_id','id');
    } 

    public function comments(){
        return $this->hasMany(Comment::class);
    }
}
