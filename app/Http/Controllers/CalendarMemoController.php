<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;

class CalendarMemoController extends Controller
{
    public function show(Request $request){
        // whereDateは、Bookモデルから指定したカラムで該当する値のレコードを絞り込んで、getでそれを配列にして返す。
        $books= Book::whereDate('date', $request->day)->get();
        // 変数の中身を初期化
        $prices = NULL;

        foreach($books as $column){
            // 代入を工夫
            $prices += $column->price;
        }

        return view('CalendarMemo', ['prices' => $prices, 'books' => $books, 'date' => $request->day]);
    }
    
    // 保存
    public function create(Request $request){
        // bookモデルにデータを保存
        // 保存した後は、CalendarMemoViewに飛ばす
        // Varidationを行う
        $request->validate(Book::$rules);
        $books = new Book;
        $books->diary = $request->diary;
        $books->spending = $request->spending;
        $books->price = $request->price;
        $books->user_id = $request->user()->id;
        $books->date = $request->date;
        
        $form = $request->all();
        // formから送られてきた_tokenを削除
        unset($form['_token']);
        // データベースに保存する
        $books->fill($form);
        $books->save();
        
        return redirect('calendar/memo?day='.$request->date);
    }
    
  
    // パラメータ
	public function index(Request $request)
	{
		$day = $request->input('day');

        return view('CalendarMemo')->with('day', $day);
	}
	
	// 更新、削除
    public function update(Request $request)
    {
        if($request->has('upd_book')){
            // $request->validate(Book::$rules);
            // 送信されてきたフォームデータを格納する
            $books_forms = $request->all();
            // formから送られてきた_tokenを削除
            unset($books_forms['_token']);
            // "book_update" => "一括更新"を除外する。
            array_pop($books_forms);
            // 配列を4つに分割する
            $books_forms = array_chunk($books_forms, 4, true);

            foreach($books_forms as $books_form){
                // 配列内の現在の要素を返す,配列の一部を展開する
                $id = current(array_slice($books_form, 0, 1, true));
                // 更新対象を検索
                $books = Book::find($id);
                // $book を更新
                $arr_book = array();
                $arr_book['price'] = current(array_slice($books_form, 1, 1, true));
                $arr_book['spending'] = current(array_slice($books_form, 2, 1, true));
                $arr_book['diary'] = current(array_slice($books_form, 3, 1, true));
                $arr_book['date'] = current(array_slice($books_form, 4, 1, true));
                // 該当するデータを上書きして保存する
                if($books != null){
                    $books->fill($arr_book);
                    $books->save();
                }
            }
            
        }elseif($request->has('del_book')){
            $books_id = array();
            // 該当するBook Modelを取得
            $books_forms = $request->all();
            $books_key = array_keys($books_forms);
            foreach($books_key as $book_key){
                // キーの名前がdelete-〇かチェックする
                if(preg_match('/delete/', $book_key)){
                    $books_id[] = $books_forms[$book_key]; 
                }
            }
            $books = Book::find($books_id);
            foreach($books as $book){
                $book->delete();
            }
        }
        
        return redirect('calendar/memo?day='.$request->date);

    }

}

