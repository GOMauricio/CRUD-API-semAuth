<?php

//Services são usados para regras de negócios, etc

namespace App\Services;
use App\Models\Book;
use App\Repositories\BookRepository;

class BookService {

    protected $bookRepository;

    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function bookAll(){
        return $this->bookRepository->all();
    }

    public function findBook($id){
        return $this->bookRepository->find($id);
    }

    public function createBook(array $data){
        return $this->bookRepository->create($data);
    }

    public function updateBook($id, array $data){
        return $this->bookRepository->update($id, $data);
    }

    public function deleteBook($id)
    {
        return $this->bookRepository->delete($id);
    }
}