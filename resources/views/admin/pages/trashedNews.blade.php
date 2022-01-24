@extends('admin.Layouts.main')
@section('title', 'News')

@section('css')
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection

@section('js')
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script>
    $(document).ready(function() {

        // recovery
        var id;
        $(".recover").click(function() {
            id = $(this).val();
            //alert(id);
            $.ajax({
                url: "{{ route('admin.recovery') }}"
                , method: "get"
                , data: {
                    id: id
                }
                , success: function() {
                    $('#' + id).hide();
                }
            });
        });

    });

</script>
@endsection
@section('content')

<x-page-info pageTitle="News page" />
<!-- DataTales Example -->
<div class="card shadow mb-3">
    <div class="card-header py-3 d-flex justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Trash news</h6>
        <h6 class="m-0">
            <a class="btn btn-sm btn-success font-weight-bold" href="{{ route('admin.news.index') }}"><i class="fas fa-fw fa-align-justify">&nbsp;</i>Watch to news</a>

        </h6>
    </div>
    <div class="card-body">
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
                        @foreach ($trashedNews as $item)
                        <tr id={{ $item->id }}>
                            <td>{{ $item->title }}</td>
                            <td><img style="width: 100%; height:80px;" src="{{ Storage::url($item->image) }}" alt="">
                            </td>

                            <td>{{ $item->category->slug }}</td>
                            <td>{{ Str::limit($item->news_content, 20) }}</td>

                            <td>{{ $item->created_at->format('d M Y h:i') }}</td>
                            <td>
                                <input value="{{ $item->id }}" data-offstyle="danger" data-onstyle="success" class="switch" type="checkbox" data-toggle="toggle" data-on="Active" data-off="Deactive" disabled @if ($item->status == 1) checked @endif>

                            </td>

                            <td>
                                <button class="recover btn btn-sm btn-success" value="{{ $item->id }}"><i class="fa fa-recycle"></i></button>

                                <a href="{{ route('admin.delete', $item->id) }}" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>
    </div>
</div>


@endsection
