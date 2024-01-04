<?php

namespace App\Services;

use App\Models\Book;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\BookUpdateRequest;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class BookService.
 */
class BookService
{
    public function getBookDataTable()
    {
        $data = Book::latest()->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('image', function ($data) {
                $url = asset('storage/' . $data->image);
                return '<img src="' . $url . '" width="100px" />';
            })
            ->addColumn('action', function ($data) {
                $edit = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="' . $data->id . '" data-original-title="Edit" class="edit btn text-white btn-info btn-sm mt-1 editBook"><i class="far fa-edit"></i> Edit</a>';
                $delete = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="' . $data->id . '" data-original-title="Delete" class="delete btn text-white btn-danger btn-sm mt-1 deleteBook"><i class="fas fa-trash"></i> Delete</a>';

                return $edit . ' ' . $delete;
            })
            ->rawColumns(['image', 'action'])
            ->make(true);
    }

    public function createBook(array $data)
    {
        $imagePath = $this->storeImage($data['image']);

        return Book::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'price' => $data['price'],
            'image' => $imagePath,
        ]);
    }

    public function getBookById($id)
    {
        $book = Book::find($id);

        return $book;
    }

    public function updateBook(Book $book, array $data)
    {
        $book->title = $data['title'];
        $book->description = $data['description'];
        $book->price = $data['price'];

        if (isset($data['image'])) {
            $this->updateBookImage($book, $data['image']);
        }

        $book->save();

        return $book;
    }

    private function updateBookImage(Book $book, $image)
    {
        $imageName = time() . '.' . $image->getClientOriginalExtension();

        $imagePath = $image->storeAs('public/images', $imageName);

        if ($book->image) {
            Storage::delete('public/' . $book->image);
        }

        $book->image = str_replace('public/', '', $imagePath);
    }

    public function deleteBook(Book $book)
    {
        $this->deleteImage($book->image);
        $book->delete();
    }

    private function storeImage($image)
    {
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $imagePath = $image->storeAs('images', $imageName, 'public');

        return $imagePath;
    }

    private function deleteImage($imagePath)
    {
        if ($imagePath) {
            Storage::delete($imagePath);
        }
    }
}
