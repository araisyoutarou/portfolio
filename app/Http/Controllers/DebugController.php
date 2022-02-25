<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;

class DebugController extends Controller
{
    public function show()
    {
        $books = Book::all();
        // $books= Book::whereDate('created_at', '2022-01-28')->get();
        // dd($books);
        
        return view('Debug', ['books' => $books]);

    }
    
    

}
