@extends('blog_Structure.Layouts.main')
@section('title', 'Home')
@section('content')

<x-header headerTitle="Home Page" headerInfo="This is home page" headerImage="home"/>
<!-- Main Content-->
<div class="container px-4 px-lg-5">
    <div class="d-flex justify-content-between">
        <div style="width:70%;">
            @foreach($news as $value)
            <div class="post-preview">
                <a href="{{ route('newsAbout',['categories'=>$value->category->slug, 'slug'=>$value->slug]) }}">

                    <h2 class="post-title">{{ $value->title }}</h2>
                    <h3 class="post-subtitle">{{ Str::limit($value->news_content, 80) }}</h3>
                </a>
                <div>
                    <img style="width: 60%; height:120px;" src="{{ Storage::url($value->image) }}" alt="">
                </div>
                <p class="post-meta">
                    Category: <a href="#!">{{ $value->category->name }}</a>
                    <span class="float-end">{{ $value->created_at->format('d M Y h:i') }}</span>

                </p>
            </div>
            <hr class="my-4" />
            @endforeach
            {{--  {{ $news->links() }}  --}}

            <div class="d-flex justify-content-end mb-4"><a class="btn btn-primary text-uppercase" href="#!">OlderPosts→</a></div>
        </div>
        @include('blog_Structure.Layouts.categoryWidget')

    </div>
</div>

@endsection
