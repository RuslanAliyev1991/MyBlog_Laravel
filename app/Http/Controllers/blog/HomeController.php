<?php

namespace App\Http\Controllers\blog;

use \App\Models\News;
use App\Models\Navbar;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public $categories;
    public $pages;
    function __construct()
    {
        $this->categories = Category::whereStatus(1)->get();
    }
    public function index($category = null)
    {
        if ($category !== null) {
            $cat = Category::where('slug', $category)->whereStatus(1)->first() ?? abort(404);
            $news = News::whereCategoryId($cat->id)->whereStatus(1)->get();
        } else {
            $news = News::orderByDesc('created_at')->whereStatus(1)->whereHas('category', function($query){
                $query->whereStatus(1);
            })->get();
        }
        return view('home', ['categories' => $this->categories, 'news' => $news]);
    }

    public function newsAbout($categories, $slug)
    {
        $check_categories = Category::where('slug', $categories)->whereStatus(1)->first() ?? abort(404);
        $check_news = News::where('slug', $slug)->whereStatus(1)
            ->whereCategoryId($check_categories->id)
            ->first() ?? abort(404);
        return view('post', ['categories' => $this->categories, 'news' => $check_news]);
    }
}