<?php

namespace App\Http\Controllers\blog;

use App\Http\Controllers\Controller;
use App\Models\Navbar;
use Illuminate\Http\Request;


class PageController extends Controller
{
    public function index($slug)
    {
        $nav_item=Navbar::whereSlug($slug)->whereStatus(1)->firstOrFail();
        return view('page',['pages'=>$nav_item]);
    }
}