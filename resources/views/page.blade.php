@extends('blog_Structure.Layouts.main')
@section('title',  $pages->title)

@section('content')

<x-header headerTitle="{{ $pages->title }} Page" headerInfo="This is {{ $pages->slug }} page" headerImage="{{ $pages->image }}" />

<main class="mb-4">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                {{ $pages->content }}
            </div>
        </div>
    </div>
</main>


@endsection

