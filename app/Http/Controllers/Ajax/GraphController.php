<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GraphController extends Controller
{
    public function index(Request $request) 
    {

        return \App\Graph::select('', '')
            ->where('month', $request->month)
            ->get();

    }

    public function months()
    {

        return \App\Graph::select('month')
            ->groupBy('month')
            ->pluck('month');

    }
}
