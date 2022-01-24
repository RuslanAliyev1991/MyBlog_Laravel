<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function changeState(Request $request)
    {
        $category = Category::find($request->id);
        $category->status = ($request->stu == 'true') ? 1 : 0;
        $category->save();
    }

    public function create(CategoryRequest $categoryRequest)
    {
        $category = Category::create(
            [
                'name' => $categoryRequest->category,
                'slug' => Str::slug($categoryRequest->category)
            ]
        );
        if ($category) {
            return redirect()->back();
        }
    }

    public function edit(Request $request)
    {
        $category = Category::findOrFail($request->id);
        return $category->name;
    }

    public function update(Request $request)
    {
        $validate=$request->validate(
            [
                'category_name' => 'required | string | alpha'
            ]
        );
        $category = Category::findOrFail($request->id);
        $category->name = $request->category_name;
        $category->slug= Str::slug($request->category_name);
        $category->save();
        if ($category) {
            return redirect()->back();
        }
    }

    public function delete(Request $request){
        $category=Category::findOrFail($request->id)->delete();
        if($category){
            return redirect()->back();
        }
    }
}