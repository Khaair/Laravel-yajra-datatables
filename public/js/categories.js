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
        ajax: categoriesIndexRoute, // Use the JavaScript variable
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    // Create new  button
    $('#createNew').click(function () {
        $('#saveBtn').val("create");
        $('#my_id').val('');
        $('#myForm').trigger("reset");
        $('#modelHeading').html("Create New");
        $('#ajaxModel').modal('show');
    });

    // Edit 
    $('body').on('click', '.editBtn', function () {
        var my_id = $(this).data('id');
        $.get(categoriesIndexRoute + '/' + my_id + '/edit', function (data) { // Use the variable
            $('#nameError').text('');
            $('#modelHeading').html("Edit");
            $('#saveBtn').val("edit");
            $('#ajaxModel').modal('show');
            $('#my_id').val(data.id);
            $('#name').val(data.name);
            
        });
    });

    // Save or Update
    $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('Sending..');
        $.ajax({
            data: $('#myForm').serialize(),
            url: categoriesStoreRoute, // Use the variable
            type: "POST",
            dataType: 'json',
            success: function (data) {
                $('#myForm').trigger("reset");
                $('#ajaxModel').modal('hide');
                $('#saveBtn').html('Save Changes');
                table.draw();
            },
            error: function (data) {
                console.log('Error:', data);
                $('#saveBtn').html('Save Changes');

                var errors = data.responseJSON.errors;
                
                // Display validation errors
                if(errors.name){
                    $('#nameError').text(errors.name[0]);
                }
               
            }
        });
    });

    // Delete
    $('body').on('click', '.deleteBtn', function () {
        var my_id = $(this).data("id");
        if(confirm("Are You sure want to delete !")){
            $.ajax({
                type: "DELETE",
                url: categoriesStoreRoute + '/' + my_id, // Use the variable
                success: function (data) {
                    table.draw();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        }
    });

        // Clear validation messages on form reset
        $('#myForm').on('reset', function() {
            $('#nameError').text('');
           
        });
});
