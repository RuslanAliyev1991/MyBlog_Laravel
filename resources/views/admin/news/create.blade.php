@extends('admin.Layouts.main')
@section('title', 'News')
@section('content')
<x-page-info pageTitle="News page" />
<div class="card shadow mb-3">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">News create</h6>
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
                <form method="POST" action="{{ route('admin.news.store') }}" enctype="multipart/form-data">
                    @csrf
                    {{-- Title --}}
                    <div class="form-group">
                        <label for="exampleInputTitle1">Title</label>
                        <input name="title" type="text" class="form-control" id="exampleInputTitle1" aria-describedby="titleHelp" value="{{ old('title') }}">
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
                               <option value="{{ $category->id }}" @if(old('category')==$category->id)
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
                         <input name="image" type="file" class="form-control-file" id="exampleFormControlFile1" value="{{ old('image') }}">
                          <div class="fail">
                              <span>@error('image')
                                  {{ $message }}
                                  @enderror</span>
                          </div>

                     </div>


                     {{-- Content --}}
                     <div class="form-group">
                         <label for="exampleFormControlFile1">Content</label>
                         <textarea class="form-control" name="content" rows="4">{{ old('content') }}</textarea>
                          <div class="fail">
                              <span>@error('content')
                                  {{ $message }}
                                  @enderror</span>
                          </div>
                     </div>

                    <button type="submit" class="btn btn-primary">Create</button>
                </form>

            </div>
        </div>


    </div>
</div>

@endsection
