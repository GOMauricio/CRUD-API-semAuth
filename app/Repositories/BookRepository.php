<?php

//Repositórios são usados para tratar/interagir com BDs

namespace App\Repositories;
use App\Models\Book;

class BookRepository {    
    
    public function all(){
        return Book::all();
    }

    public function find($id){
        return Book::find($id);
    }

    public function create(array $data){
        return Book::create($data);
    }

    public function update($id, array $data){
        $book = $this->find($id);

        if($book){
            $book->update($data);
            return $book;
        }
        return null;
    }

    public function delete($id){
        $book = $this->find($id);

        if($book){
            return $book->delete();
        }
        return false;
    }
}