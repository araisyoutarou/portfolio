<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Calendar\CalendarView;

class CalendarController extends Controller
{
    public function show(){
		
		//time()は、UNIXタイムスタンプ（現在）を取得するための関数。
		$calendar = array(new CalendarView(strtotime('2022-1')), 
		                  new CalendarView(strtotime('2022-2')), 
		                  new CalendarView(strtotime('2022-3')), 
		                  new CalendarView(strtotime('2022-4')),
		                  new CalendarView(strtotime('2022-5')),
		                  new CalendarView(strtotime('2022-6')),
		                  new CalendarView(strtotime('2022-7')),
		                  new CalendarView(strtotime('2022-8')),
		                  new CalendarView(strtotime('2022-9')),
		                  new CalendarView(strtotime('2022-10')),
		                  new CalendarView(strtotime('2022-11')),
		                  new CalendarView(strtotime('2022-12'))
		                  );
		
	    

		//dd(date("Y/m/d H:i:s",$time));
		
		return view('calendar', [
			"calendar" => $calendar
		]);
	}
	
	
}
