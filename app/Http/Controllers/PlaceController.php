<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlaceController extends Controller
{
    public function index()
   {
       // ソート済みの配列を返す
       $keys = ['家','研究室','外出','学内','長期不在'];
       $counts = [10,4,3,2,1];
       return view('chart',compact('keys','counts'));
   }
}
