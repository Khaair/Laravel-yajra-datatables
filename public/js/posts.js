$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // DataTable initialization
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: postsIndexRoute, // Use the JavaScript variable
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'title', name: 'title'},
            {data: 'body', name: 'body'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    // Create new post button
    $('#createNewPost').click(function () {
        $('#saveBtn').val("create-post");
        $('#post_id').val('');
        $('#postForm').trigger("reset");
        $('#modelHeading').html("Create New Post");
        $('#ajaxModel').modal('show');
    });

    // Edit post
    $('body').on('click', '.editPost', function () {
        var post_id = $(this).data('id');
        $.get(postsIndexRoute + '/' + post_id + '/edit', function (data) { // Use the variable
            $('#modelHeading').html("Edit Post");
            $('#saveBtn').val("edit-post");
            $('#ajaxModel').modal('show');
            $('#post_id').val(data.id);
            $('#title').val(data.title);
            $('#body').val(data.body);
        });
    });

    // Save or Update post
    $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('Sending..');
        $.ajax({
            data: $('#postForm').serialize(),
            url: postsStoreRoute, // Use the variable
            type: "POST",
            dataType: 'json',
            success: function (data) {
                $('#postForm').trigger("reset");
                $('#ajaxModel').modal('hide');
                $('#saveBtn').html('Save Changes');
                table.draw();
            },
            error: function (data) {
                console.log('Error:', data);
                $('#saveBtn').html('Save Changes');
            }
        });
    });

    // Delete post
    $('body').on('click', '.deletePost', function () {
        var post_id = $(this).data("id");
        if(confirm("Are You sure want to delete !")){
            $.ajax({
                type: "DELETE",
                url: postsStoreRoute + '/' + post_id, // Use the variable
                success: function (data) {
                    table.draw();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        }
    });
});
