<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GraphController extends Controller
{
    public function index(Request $request) 
    {

        return \App\Sale::select('spending_graph', 'income_graph')
            ->where('month', $request->month)
            ->get();

    }

    public function months()
    {

        return \App\Sale::select('month')
            ->groupBy('month')
            ->pluck('month');

    }
}
