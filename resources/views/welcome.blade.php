<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    {{-- jQuery DataTables --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    {{-- Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    {{-- Sweet Alert --}}
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css" rel="stylesheet">
    @stack('css')
    @vite(['resources/css/app.css'])
</head>

<body>

    @include('sweetalert::alert')

    <div class="container mt-5">
        <div class="row">
            <div class="card">
                <div class="card-header justify-content-between">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">CRUD Book</h4>
                        <button class="btn btn-primary btn-sm" id="addBook"><i class="fas fa-plus"></i> Add
                            Book</button>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped table-crud">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('book_modal')

    {{-- jQuery DataTables --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    {{-- Sweet Alert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
    <script>
        const bookIndex = '{{ route('book.index') }}';
        const bookStore = '{{ route('book.store') }}';
        const bookEdit = '{{ route('book.edit', ['id' => 'book_id']) }}';
        const bookUpdate = '{{ route('book.update', ['id' => 'book_id']) }}';
        const bookDelete = '{{ route('book.delete', ['id' => 'book_id']) }}';
    </script>
    @vite(['resources/js/ajax.js'])
    @vite(['resources/js/csrf.js'])
</body>

</html>
