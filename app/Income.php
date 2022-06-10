<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    // テーブルの紐付け
    protected $table = 'incomes';
    
    // プライマリキー
    protected $primaryKey = 'income_id';
    
    // 更新可能カラム
    protected $fillable  = array(
        'income', 'income_spending', 'income_diary', 'user_id',
        );
    
}
