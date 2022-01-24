@extends('blog_Structure.Layouts.main')
@section('title','Post')
@section('content')

<x-header headerTitle="{{ $news->slug }}" headerInfo="{{ Str::limit($news->news_content, 30,'') }}" postBy="Posted by {{ $news->category->slug ?? null }} on {{ $news->created_at->format('M d, Y') }}" headerImage="{{ $news->image }}"/>

<!-- Post Content-->
<article class="mb-4">
    <div class="container px-4 px-lg-5">
        <div class="d-flex justify-content-between">

            <div style="width:70%;">
                <p>
                    {{ $news->news_content }}
                </p>
            </div>
            @include('blog_Structure.Layouts.categoryWidget')
        </div>
    </div>
</article>
@endsection
