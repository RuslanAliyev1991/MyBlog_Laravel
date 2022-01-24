@extends('admin.Layouts.main')
@section('title', 'News')
@section('content')
<x-page-info pageTitle="News page" />
<div class="card shadow mb-3">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">News update</h6>
    </div>
    <div class="card-body">
        <div class="row">
            <div style="height:50px; width:100%; padding:5px 0 5px 0; margin-top:20px;">
                <h2 class="text-left text-success">
                    @if(Session::has('success'))
                    {{ Session::get('success') }}
                    @endif
                </h2>
            </div>

        </div>
        <div class="row">
            <div class="col-6">
                <form method="POST" action="{{ route('admin.news.update', $news->id) }}" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    {{-- Title --}}
                    <div class="form-group">
                        <label for="exampleInputTitle1">Title</label>
                        <input name="title" type="text" class="form-control" id="exampleInputTitle1" aria-describedby="titleHelp" value="{{ $news->title }}">
                        <div class="fail">
                            <span>@error('title')
                                {{ $message }}
                                @enderror</span>
                        </div>

                    </div>

                    {{-- Category --}}
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Select Category</label>
                        <select name="category" class="form-control" id="exampleFormControlSelect1">
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}" @if($news->category_id==$category->id)
                                selected
                                @endif>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <div class="fail">
                            <span>@error('category')
                                {{ $message }}
                                @enderror</span>
                        </div>

                    </div>

                    {{-- Image --}}
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Select Image</label>
                        <div style="width: 300px;">
                            <img class="rounded img-thumbnail" src="{{ Storage::url($news->image) }}" alt="">
                            <input type="hidden" name="imgHidden" value="{{ $news->image }}">
                        </div>
                        <input name="image" type="file" class="form-control-file" id="exampleFormControlFile1" value="{{ Storage::url($news->image) }}">

                        <div class="fail">
                            <span>@error('image')
                                {{ $message }}
                                @enderror</span>
                        </div>

                    </div>


                    {{-- Content --}}
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Content</label>
                        <textarea class="form-control" name="content" rows="4">{{ $news->news_content }}</textarea>
                        <div class="fail">
                            <span>@error('content')
                                {{ $message }}
                                @enderror</span>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>

            </div>
        </div>


    </div>
</div>

@endsection
