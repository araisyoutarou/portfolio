<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;

class CalendarMemoController extends Controller
{
    public function show(){
        // whereDateは、Bookモデルから指定したカラムで該当する値のレコードを絞り込んで、getでそれを配列にして返す。
        $date= Book::whereDate('created_at', '2022-01-28')->get();
        // dd($date);
        foreach($date as $diary){
            // 代入を工夫
            $memo = $diary->diary;
        }
        // dd($memo);
        return view('CalendarMemo', ['date' => $date, 'diary' => $diary]);
        
    }
    
    // 保存
    public function create(Request $request){
        // bookモデルにデータを保存
        // 保存した後は、CalendarMemoViewに飛ばす
        // Varidationを行う
        $this->validate($request, Book::$rules, [
            'diary' => 'required',
            'income' => 'required',
            'spending' => 'required',
            'price' => 'required',
            'user_id' => 'required',
        ]);
        
        $books = new Book;
        $books->diary = $request->diary;
        $books->income = $request->income;
        $books->spending = $request->spending;
        $books->price = $request->price;
        $books->user_id = $request->user()->id;
        
        $form = $request->all();
        
        unset($form['_token']);
      
        // データベースに保存する
        $books->fill($form);
        $books->save();
        
        
        //dd($books);

        return redirect('/');
    }
    
    // 編集(データの取得)
    public function edit(Request $request)
    {
        // Book Modelからデータを取得する
        $books = Book::find($request->id);
        if (empty($books)) {
            abort(404);    
            
        }
        
        //dd($books);
        return view('CalendarEdit', ['books_form' => $books]);
        
    }
    
    // 編集(上書き保存)
    public function update(Request $request)
    {
        // Validationをかける
        $this->validate($request, Book::$rules);
        // Book Modelからデータを取得する
        $books = Book::find($request->id);
        // 送信されてきたフォームデータを格納する
        $books_form = $request->all();
        unset($books_form['_token']);
        
        // 該当するデータを上書きして保存する
        $books->fill($books_form)->save();
        
        return redirect('/');
  }
  
    // 削除
    public function delete(Request $request)
    {
        // 該当するBook Modelを取得
        $books = Book::find($request->id);
        // 削除する
        $books->delete();
        
        return redirect('/');
  }  

  
    // パラメータ
	public function index(Request $request)
	{
		$day = $request->input('day');
		//dd($value);
        return view('CalendarMemo')->with('day', $day);
		
	}
}
