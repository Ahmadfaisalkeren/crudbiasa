$(function () {
    var table = $('.table-crud').DataTable({
        processing: true,
        serverSide: true,
        ajax: bookIndex,
        columns: [
        {
            data: 'DT_RowIndex',
            name: 'DT_RowIndex',
        },
        {
            data: 'title',
            name: 'title',
        },
        {
            data: 'description',
            name: 'description',
        },
        {
            data: 'price',
            name: 'price',
        },
        {
            data: 'image',
            name: 'image',
        },
        {
            data: 'action',
            name: 'action',
        },
    ]
    });

    $('#addBook').click(function () {
        $('#exampleModalLabel').html("Add Book");
        $('#saveBook').show();
        $('#updateBook').hide();
        $('#saveBook').val("create-book");
        $('#book_id').val('');
        $('#bookForm').trigger('reset');
        $('#bookModal').modal('show');
    })

    $('#saveBook').click(function (e) {
        e.preventDefault();

        var formData = new FormData($("#bookForm")[0]);

        var url = bookStore;
        var method = "POST";

        $.ajax({
            data: formData,
            processData: false,
            contentType: false,
            url: url,
            type: method,
            dataType: 'json',
            success: function (data) {
                $('#bookForm').trigger("reset");
                $('#bookModal').modal('hide');
                table.draw();
                Swal.fire({
                    title: "Success!",
                    text: "The book has been added successfully.",
                    icon: "success",
                    timer: 3000
                });
            },
            error: function(data) {
                console.log('Error:', data);
            }
        });
    });

    $('#image').on('change', function() {
        var input = this;
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#current_image').attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    });

    $('body').on('click', '.editBook', function () {
        var book_id = $(this).data('id');
        $.get(bookEdit.replace('book_id', book_id), function (data) {
            $('#exampleModalLabel').html("Edit Book");
            $('#saveBook').hide();
            $('#updateBook').show();
            $('#updateBook').val("edit-book");
            $('#bookModal').modal('show');
            $('#book_id').val(data.id);
            $('#title').val(data.title);
            $('#description').val(data.description);
            $('#price').val(data.price);
            $('#current_image').attr('src', 'storage/' + data.image);
        });
    });

    $('#updateBook').click(function(e) {
        e.preventDefault();

        var book_id = $('#book_id').val();
        var url = bookUpdate.replace('book_id', book_id);
        var method = 'PUT';

        var formData = new FormData($('#bookForm')[0]);
        formData.append('_method', method);

        $.ajax({
            data: formData,
            url: url,
            type: 'POST',
            contentType: false,
            processData: false,
            success: function(data) {
                $('#bookForm').trigger("reset");
                $('#bookModal').modal('hide');
                table.draw();
                Swal.fire({
                    title: "Success!",
                    text: "The book has been updated successfully.",
                    icon: "success",
                    timer: 3000
                });
            },
            error: function(data) {
                console.log('Error:', data);
            }
        });
    });

    $('body').on('click', '.deleteBook', function () {
        var book_id = $(this).data('id');

        Swal.fire({
            title: 'Are You sure want to delete Book Data?',
            text: 'Deleted Data Can not be Revert!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Delete!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                var url = bookDelete.replace('book_id', book_id);

                $.ajax({
                    url: url,
                    type: 'DELETE',
                    dataType: 'json',
                    success: function(data) {
                        const dataTable = $('.table-crud').DataTable();
                        dataTable.row(`[data-id="${data.id}"]`).remove().draw();
                        Swal.fire({
                            title: 'Book Deleted Successfully!',
                            icon: 'success',
                        });
                    },
                    error: function(data) {
                        console.log('Error:', data);
                        alert('Failed To Delete Data');
                    }
                });
            }
        });
     })


})
