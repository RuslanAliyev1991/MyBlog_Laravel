<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    use SoftDeletes;
    protected $table = 'news';
    protected $fillable = [
        'title',
        'category_id',
        'news_content',
        'slug',
        'image'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id','id');
        //return $this->hasOne(Category::class,'id','category_id');
    }

    // public function categoryActive(){
    //     return 
    // }
}