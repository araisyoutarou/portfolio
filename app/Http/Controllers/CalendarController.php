<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Calendar\CalendarView;

class CalendarController extends Controller
{
    public function show(Request $request){
		date_default_timezone_set('UTC');
		$year = $request->year;
		$month = $request->month;
		$calendar = array(new CalendarView(strtotime($year . '-1')));
		// もし$yearがnullかつ$monthがnullだったら
		if($year == null && $month == null){
			// $yearに現在の年を代入,$monthに現在の月を代入する
			$year = date('Y');
			$month = date('n');
		} elseif($month == 'year'){
			$calendar = array(
				new CalendarView(strtotime($year . '-1')),
				new CalendarView(strtotime($year . '-2')), 
		        new CalendarView(strtotime($year . '-3')), 
		        new CalendarView(strtotime($year . '-4')),
		        new CalendarView(strtotime($year . '-5')),
		        new CalendarView(strtotime($year . '-6')),
		        new CalendarView(strtotime($year . '-7')),
		        new CalendarView(strtotime($year . '-8')),
		        new CalendarView(strtotime($year . '-9')),
		        new CalendarView(strtotime($year . '-10')),
		        new CalendarView(strtotime($year . '-11')),
		        new CalendarView(strtotime($year . '-12'))
		       );
		} else{
			$calendar = array(new CalendarView(strtotime($year . '-' . $month)));
		
		}
		
		return view('calendar', ["calendar" => $calendar, "year" => $year, "month" => $month]);
	}
	
	
}
