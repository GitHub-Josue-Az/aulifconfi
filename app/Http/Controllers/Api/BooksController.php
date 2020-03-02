<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Book;

class BooksController extends Controller{
    
    public function index(){
        
        $books = Book::where('deleted', 0)->with('lessons')->get();
        
//        return response()->json(compact('books'));
        return response()->json($books);
    }
    
    public function show($id){
        
        $book = Book::with('lessons')->findOrFail($id);
        
//        return response()->json(compact('book'));
        return response()->json($book);
    }
    
    public function image($id) {
        
        $book = Book::findOrFail($id);
        
        $content = Storage::get($book->image);
        $mimetype = Storage::mimeType($book->image);
        $size = Storage::size($book->image);
        
        return response($content)   // https://laravel.com/docs/5.4/responses
                ->header('Content-Type', $mimetype)
                ->header('Content-Length', $size);
    }
    
}
