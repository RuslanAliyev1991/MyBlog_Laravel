@extends('blog_Structure.Layouts.main')
@section('title', 'Contact')

@section('content')
<x-header headerTitle="Contact Page" headerInfo="This is contact page" headerImage="contact"/>
<main class="mb-4">
    <div class="container px-4 px-lg-5">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <p>Want to get in touch? Fill out the form below to send me a message and I will get back to you as soon as possible!
                </p>
            </div>
        </div>
        <div class="row justify-content-center">
            @if(session('insert'))
                <div class="alert alert-success">{{ session('insert') }}</div>
            @endif
            <div class="my-5 col-md-10 col-lg-6 col-xl-5">
                <form method="post" action="{{ route('store') }}">
                    @csrf
                    {{-- name --}}
                    <div class="form-group mb-3">
                        <label for="name">Name</label>
                        <input name="name" type="text" class="form-control" id="name" placeholder="{{$errors->first('name')}}" @if(!$errors->first('name'))
                        value="{{ old('name') }}" @endif>
                    </div>
                    {{-- email --}}
                    <div class="form-group mb-3">
                        <label for="email">Email</label>
                        <input name="email" type="text" class="form-control" id="email" placeholder="{{$errors->first('email')}}" @if(!$errors->first('email'))
                        value="{{ old('email') }}" @endif>
                    </div>
                    {{-- phone --}}
                    <div class="form-group mb-3">
                        <label for="phone">Phone</label>
                        <input name="phone" type="text" class="form-control" id="phone" placeholder="{{$errors->first('phone')}}" @if(!$errors->first('phone'))
                        value="{{ old('phone') }}" @endif >
                    </div>

                    {{-- comment --}}
                    <div class="form-group mb-3">
                        <label for="message">Comment</label>
                        <textarea class="form-control" name="message" id="message" cols="30" rows="10" placeholder="{{$errors->first('message')}}"></textarea>
                    </div>

                    <input class="btn btn-primary text-uppercase" type="submit" value="Send">

                </form>
            </div>
        </div>

    </div>
</main>

@endsection
