<?php

namespace App\Http\Controllers\blog;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function store(ContactRequest $request)
    {
        $insert = Contact::create($request->except('_token')) ?? false;
        if ($insert) {
            return redirect()->route('contact')->with('insert', 'Success');
        }
    }
}
