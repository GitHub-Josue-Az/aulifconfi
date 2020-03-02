<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Book;
use App\Models\Lesson;

class BooksController extends Controller{
    
    public function index(){
        
        $books = Book::where('deleted', 0)->get();
        
        return view('admin.books.index', compact('books'));
    }
    
    public function create(){
        
        $lessons = Lesson::where('deleted', 0)->get()->pluck('title', 'id');
        
        return view('admin.books.create', compact('lessons'));
    }
    
    public function store(Request $request) {
        
        $request->validate([
            'title' => 'required|max:100',
            'file' => 'max:1024|mimes:jpg,jpeg,png,gif', 
        ]);
        
        if($request->hasFile('file') && $request->file('file')->isValid()){
            $image = $request->file('file')->store('books');
            $request->merge(['image' => $image]);
        }
        
        $book = Book::create($request->all());
        $book->lessons()->sync($request->input('lessons'));

        return redirect()->route('admin.books.index')->with('success', 'Registro guardado satisfactoriamente');
    }
    
    public function show($id){
        
        $book = Book::findOrFail($id);
        
        return view('admin.books.show', compact('book'));
    }
    
    public function edit($id){
        
        $book = Book::findOrFail($id);
        
        $lessons = Lesson::where('deleted', 0)->get()->pluck('title', 'id');
        
        return view('admin.books.edit', compact('book', 'lessons'));
    }
    
    public function update(Request $request, $id) {
        
        $request->validate([
            'title' => 'required|max:100',
            'file' => 'max:1024|mimes:jpg,jpeg,png,gif', 
        ]);
        
        if($request->has('file-delete')){
            $request->merge(['image' => null]);
        } else if($request->hasFile('file') && $request->file('file')->isValid()){
            $image = $request->file('file')->store('books');
            $request->merge(['image' => $image]);
        }
        
        $book = Book::findOrFail($id);
        $book->update($request->all());
        $book->lessons()->sync($request->input('lessons'));

        return redirect()->route('admin.books.index')->with('success', 'Registro guardado satisfactoriamente');
    }
    
    public function destroy($id){
        
        $book = Book::findOrFail($id);
        $book->deleted = 1;
        $book->save();
//        $book->delete();

        return redirect()->route('admin.books.index')->with('success', 'Registro eliminado satisfactoriamente');
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
