<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Services\BookService;
use App\Http\Requests\BookRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\BookUpdateRequest;
use Yajra\DataTables\Facades\DataTables;

class BookController extends Controller
{
    protected $bookService;

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->bookService->getBookDataTable();
        }
    }

    public function store(BookRequest $request)
    {
        $resource = $this->bookService->createBook($request->validated());

        return response()->json([
            'success' => 'Book Added Successfully',
            'resource' => $resource,
        ]);
    }

    public function edit($id)
    {
        $book = $this->bookService->getBookById($id);

        return response()->json($book);
    }

    public function update(BookUpdateRequest $request, $id)
    {
        $book = Book::findOrFail($id);
        $this->bookService->updateBook($book, $request->validated());

        return response()->json([
            'success' => 'Book Updated Successfully',
        ]);
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $this->bookService->deleteBook($book);

        return response()->json([
            'success' => 'Resource Deleted Successfully',
        ]);
    }
}
