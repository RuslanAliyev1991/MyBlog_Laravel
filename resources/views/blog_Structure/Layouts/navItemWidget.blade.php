@foreach($links as $link)
    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="{{ route('page', $link->slug) }}">{{ $link->slug }}</a></li>
@endforeach