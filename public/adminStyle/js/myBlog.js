$(document).ready(function () {
    var id;
    var stu;
    $(".switch").change(function () {
        id = $(this).val();
        stu = $(this).prop("checked");
        $.ajax({
            url: "{{ route('admin.state') }}",
            method: "get",
            data: {
                id: id,
                stu: stu,
            },
        });
    });
});
