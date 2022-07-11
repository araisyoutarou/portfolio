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
		$calendar = array(new CalendarView(strtotime($year . '-01')));
		// もし$yearがnullかつ$monthがnullだったら
		if($year == null && $month == null){
			// $yearに現在の年を代入,$monthに現在の月を代入する
			$year = date('Y');
			$month = date('m');
		} elseif($month == 'year'){
			$calendar = array(
				new CalendarView(strtotime($year . '-01')),
				new CalendarView(strtotime($year . '-02')), 
		        new CalendarView(strtotime($year . '-03')), 
		        new CalendarView(strtotime($year . '-04')),
		        new CalendarView(strtotime($year . '-05')),
		        new CalendarView(strtotime($year . '-06')),
		        new CalendarView(strtotime($year . '-07')),
		        new CalendarView(strtotime($year . '-08')),
		        new CalendarView(strtotime($year . '-09')),
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
