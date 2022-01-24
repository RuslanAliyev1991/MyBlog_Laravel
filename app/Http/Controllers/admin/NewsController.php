<?php

namespace App\Http\Controllers\admin;

use App\Models\News;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\NewsRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\NewsEditRequest;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    function __construct()
    {
        $this->categories = Category::all();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::orderBy('created_at', 'asc')->get();
        return view('admin.news.index', ['news' => $news, 'categories' => $this->categories]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$categories = Category::all();
        return view('admin.news.create', ['categories' => $this->categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsRequest $request)
    {
        if ($request->hasFile('image')) {
            $news = News::create(
                [
                    'title' => $request->title,
                    'category_id' => $request->category,
                    'news_content' => $request->content,
                    'image' => Storage::putFileAs('public/images/news', $request->file('image'), uniqid()),
                    'slug' => Str::slug($request->title)
                ]
            );
            if ($news) {
                return redirect()->back()->with('success', 'Success');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $news = News::findOrFail($id);
        return view('admin.news.edit', ['news' => $news, 'categories' => $this->categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NewsEditRequest $request, $id)
    {
        $news = News::find($id)->update(
            [
                'title' => $request->title,
                'category_id' => $request->category,
                'news_content' => $request->content,
                'image' => ($request->file('image') != null) ? Storage::putFileAs('public/images/news', $request->file('image'), uniqid()) : $request->imgHidden,
                'slug' => Str::slug($request->title)
            ]
        );
        if ($request->hasFile('image')) {
            Storage::delete($request->imgHidden);
        }

        if ($news) {
            return redirect()->back()->with('success', 'Success');
        }
    }

    public function changeState(Request $request)
    {
        $news = News::find($request->id);
        $news->status = ($request->stu == 'true') ? 1 : 0;
        $news->save();
    }


    public function newsTrash($id)
    {
        $news = News::find($id)->delete();
        if ($news) {
            return redirect()->route('admin.news.index');
        }
    }

    public function trash()
    {
        $trashedNews = News::onlyTrashed()->orderBy('deleted_at', 'asc')->get();
        return view('admin.news.trashedNews', compact('trashedNews'));
    }

    public function newsRecovery(Request $request)
    {
        $news = News::onlyTrashed()->find($request->id)->restore();
        if ($news) {
            return true;
        }
    }

    public function hardDelete($id)
    {
        $news = News::onlyTrashed()->find($id);
        Storage::delete($news->image);
        $news->forceDelete();
        if ($news) {
            return redirect()->back();
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}