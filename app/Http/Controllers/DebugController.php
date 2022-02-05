<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;

class DebugController extends Controller
{
    public function show()
    {
        $books = Book::all();
        //dd($books);
        
        return view('Debug', ['books' => $books]);

    }
    
    

}
