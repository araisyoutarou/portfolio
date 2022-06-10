<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    // テーブルの紐付け
    protected $table = 'books';
    
    // プライマリキー
    protected $primaryKey = 'id';
    
    // 更新可能カラム
    protected $fillable  = array(
        'diary', 'spending', 'price', 'user_id',
        );
    
    //
    public static $rules = array(
        'price' => 'required|numeric|digits_between:1,9',
        'spending' => 'required',
        'diary' => 'required|string|max:100',
    );
    
   

   
}
