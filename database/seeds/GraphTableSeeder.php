<?php

use Illuminate\Database\Seeder;

class GraphTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $spending = [
            '食費',
            '外食',
            '日用品',
            '水道光熱費',
            '通信費',
            '交通費',
            'カード決済',
            '税金',
            'その他',
            ];
            
            for($i = 0 ; $i < 100 ; $i++) {
                $sale = new \App\Sale();
                $sale->spending_graph = Arr::random($spending);
                $sale->income_graph = rand(1000, 10000) * 10;
                $sale->month = rand(1, 12);
                $sale->save();
                
            }
        
    }
}
