<div style="width: 25%;">
    <div class="card" style="margin-top: 1.875rem;">

        <div class="card-header">
            Categories
        </div>
        <div class="list-group">

            @foreach($categories as $category)
            @if($category->news->count()!==0)
            <a href="{{ route('categoryAbout', $category->slug) }}" class="list-group-item @if(Request::segment(2)==$category->slug) text-danger @endif">{{ $category->slug }}
                <span class="badge bg-primary float-end">{{ $category->news->count() }}</span></a>
            @endif
            @endforeach
        </div>
    </div>
</div>
