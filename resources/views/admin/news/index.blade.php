@extends('admin.Layouts.main')
@section('title', 'News')

@section('css')
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection

@section('js')
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script>
    $(document).ready(function() {
        var id;
        var stu;
        $(".switch").change(function() {
            id = $(this).val();
            stu = $(this).prop("checked");
            $.ajax({
                url: "{{ route('admin.state') }}"
                , method: "get"
                , data: {
                    id: id
                    , stu: stu
                , }
            , });
        });
    });

</script>

@endsection
@section('content')

<x-page-info pageTitle="News page" />

<!-- DataTales Example -->
<div class="card shadow mb-3">
    <div class="card-header py-3 d-flex justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">News</h6>
        <h6 class="m-0">
            <a class="btn btn-sm btn-warning font-weight-bold" href="{{ route('admin.trash') }}"><i class="fa fa-trash">&nbsp;</i>Watch to trash</a>
        </h6>
    </div>
    <div style="height:500px;overflow-y: scroll;text-overflow: ellipsis;white-space: nowrap;" class="card-body">

        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Category</th>
                        <th>Content</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Change data</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($news as $item)
                    <tr>
                        <td>{{ $item->title }}</td>
                        <td><img style="width: 100%; height:80px;" src="{{ Storage::url($item->image) }}" alt="">
                        </td>

                        <td>{{ $item->category->slug }}</td>
                        <td>{{ Str::limit($item->news_content, 20) }}</td>

                        <td>{{ $item->created_at->format('d M Y h:i') }}</td>
                        <td>
                            <input value="{{ $item->id }}" data-offstyle="danger" data-onstyle="success" class="switch" type="checkbox" data-toggle="toggle" data-on="Active" data-off="Deactive" @if ($item->status == 1) checked @endif>

                        </td>

                        <td>
                            <a href="#" class="btn btn-sm btn-success"> <i class="fa fa-eye"></i></a>
                            <a href="{{ route('admin.news.edit', $item->id) }}" class="btn btn-sm btn-primary"> <i class="fa fa-pen"></i></a>
                            <a href="{{ route('admin.trashedNews', $item->id) }}" class="btn btn-sm btn-danger"> <i class="fa fa-times"></i></a>


                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>






@endsection
