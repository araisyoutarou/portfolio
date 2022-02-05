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
        'diary', 'income', 'spending', 'price', 'user_id',
        );
    
    //
    public static $rules = array(
        'income' => 'required',
        'spending' => 'required',
        'price' => 'required',
        'diary' => 'required',
    );
    
   

   
}
