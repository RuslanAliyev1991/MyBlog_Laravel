@extends('admin.Layouts.main')
@section('title', 'Category')

@section('css')
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection

@section('js')
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script>
    $(document).ready(function() {
        var id;
        var delete_category;
        var stu;
        $(".switch").change(function() {
            id = $(this).val();
            stu = $(this).prop("checked");
            $.ajax({
                url: "{{ route('admin.category.state') }}"
                , method: "get"
                , data: {
                    id: id
                    , stu: stu
                , }
            , });
        });

        // edit category:

        $(".edit").click(function() {
            id = $(this).val();
            $.ajax({
                url: "{{ route('admin.category.edit') }}"
                , method: "get"
                , data: {
                    id: id
                }
                , success: function(data) {
                    $('#category').val(data);
                    $('#id').val(id);
                    $('#EditModal').modal();
                }
            });
        });

        // Delete category:
        $(".delete").click(function() {
            delete_category = $(this).val();
            count = $(this)[0].getAttribute('data-count');
            $('#body').html = '';
            $('#body').hide();
            if (count > 0) {
                $('#body').html('This category have ' + count + ' news. Are you sure?');
                $('#body').show();
            }
            $('#DeleteModal').modal();
        });

        $('#delete_category').click(function() {
            $.ajax({
                url: "{{ route('admin.category.delete') }}"
                , method: "get"
                , data: {
                    id: delete_category
                },
                success:function(data){
                    if(data){
                        location.reload();
                    }
                }
            });

        });

    });

</script>

@endsection

@section('content')
<x-page-info pageTitle="Category page" />
<div class="row">
    <div class="col-4">
        <div class="card shadow mb-3">
            <div class="card-header py-3 d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Create category</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.category.create') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputTitle1">Category</label>
                        <input autocomplete="off" name="category" type="text" class="form-control" id="exampleInputTitle1" aria-describedby="titleHelp" value="{{ old('category') }}">
                        <div class="fail">
                            <span>@error('category')
                                {{ $message }}
                                @enderror</span>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-block btn-primary">Create</button>
                </form>
            </div>
        </div>


    </div>
    <div class="col-8">
        <div class="card shadow mb-3">
            <div class="card-header py-3 d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Categories list</h6>
            </div>
            <div style="height:500px;overflow-y: scroll;text-overflow: ellipsis;white-space: nowrap;" class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>News count</th>
                                <th>Status</th>
                                <th>Change data</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                            <tr>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->news->count() }}</td>
                                <td>
                                    <input value="{{ $category->id }}" data-offstyle="danger" data-onstyle="success" class="switch" type="checkbox" data-toggle="toggle" data-on="Active" data-off="Deactive" @if ($category->status == 1) checked @endif>

                                </td>

                                <td>
                                    <button value="{{ $category->id }}" type="button" class="edit btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-edit"></i>
                                    </button>
                                    <button data-count="{{ $category->news->count() }}" value="{{ $category->id }}" type="button" class="delete btn btn-sm btn-danger" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-times"></i>

                                    </button>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- DataTales Example -->

<!-- Modal Edit -->
<div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Update category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.category.update') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputTitle1">Category</label>
                        <input autocomplete="off" name="category_name" type="text" class="form-control" id="category">
                        <input id="id" type="hidden" name="id">
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-danger mr-2" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal Delete -->
<div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Delete category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="body" class="alert alert-danger" class="modal-body">
            </div>
            <div class="modal-footer">
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal">Close</button>
                    <button id="delete_category" type="submit" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
