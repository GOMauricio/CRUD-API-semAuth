<?php

namespace App\Http\Controllers;

use App\Services\BookService;
use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    protected $bookService;

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    public function index()
    {
        $books = $this->bookService->bookAll();
        return response()->json($books);
    }

    public function show($id){
        $book = $this->bookService->findBook($id);

        if ($book) {
            return response()->json($book);
        }
        return response()->json(['message' => 'Livro não encontrado.']);
    }

    public function store(Request $request){
        // Validação dos dados
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'genre' => 'required|string|max:50',
            'published_year' => 'required|integer|min:1600|max:'.date('Y'),
        ]);

    $book = $this->bookService->createBook($validatedData);

    return response()->json([
        'message' => 'Livro criado com sucesso',
        'data' => $book
    ], 201);
    }

    public function update(Request $request, $id){
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'genre' => 'required|string|max:50',
            'published_year' => 'required|integer|min:1600|max:'.date('Y'),
        ]);

        $updated = $this->bookService->updateBook($id, $validated);
    
        if ($updated) {
            return response()->json(['message' => 'Livro atualizado com sucesso!'], 200);
        } else {
            return response()->json(['message' => 'Erro ao atualizar o livro.'], 500);
        }
    }
    

    public function destroy($id)
    {
        $deleted = $this->bookService->deleteBook($id);

        if($deleted){
            return response()->json(['message' => 'Livro excluído do banco de dados.']);
        }
        return response()->json(['message' => 'Erro ao excluir o livro.']);
    }
}
