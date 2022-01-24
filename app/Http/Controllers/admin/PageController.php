<?php

namespace App\Http\Controllers\admin;

use App\Models\Navbar;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\PageRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\PageEditRequest;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    public function index()
    {
        $pages = Navbar::all();
        return view('admin.pages.index', compact('pages'));
    }

    public function changeState(Request $request)
    {
        $page = Navbar::findOrFail($request->id);
        $page->status = ($request->stu == 'true') ? 1 : 0;
        $page->save();
    }

    public function create()
    {
        return view('admin.pages.create');
    }

    public function store(PageRequest $request)
    {
        if ($request->hasFile('image')) {
            $page = Navbar::create(
                [
                    'title' => $request->title,
                    'content' => $request->content,
                    'image' => Storage::putFileAs('public/images/pages', $request->file('image'), uniqid()),
                    'slug' => Str::slug($request->title),
                ]
            );
            if ($page) {
                return redirect()->back()->with('success', 'Success');
            }
        }
    }

    public function edit($id)
    {
        $pages = Navbar::findOrFail($id);
        return view('admin.pages.edit', ['pages' => $pages]);
    }

    public function update(PageEditRequest $request, $id)
    {
        $pages = Navbar::find($id)->update(
            [
                'title' => $request->title,
                'content' => $request->content,
                'image' => ($request->file('image') != null) ? Storage::putFileAs('public/images/pages', $request->file('image'), uniqid()) : $request->imgHidden,
                'slug' => Str::slug($request->title)
            ]
        );
        if ($request->hasFile('image')) {
            Storage::delete($request->imgHidden);
        }

        if ($pages) {
            return redirect()->back()->with('success', 'Success');
        }
    }
}