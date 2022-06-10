@extends('layouts.app')
@section('content')
<div class="button">
   <button disabled>カレンダー</button>
   <button onclick="location.href='https:/graph'">円グラフ</button>
</div>
<h1 class="title">家計簿アプリ</h1>
<div class="years">
   <th>年を選択</th>
   <select id="yearSelect" name="year" onChange="showCalender()"> 
      <option value="/?year=2023">2023年</option>
      <option value="/?year=2022">2022年</option>
      <option value="/?year=2021">2021年</option>
      <option value="/?year=2020">2020年</option>
      <option value="/?year=2019">2019年</option>
      <option value="/?year=2018">2018年</option>
   </select>
   <th>月を選択</th>
   <select id="monthSelect" name="month" onChange="showCalender()">
      <option value="&month=year">年間</option>
      <option value="&month=1">1月</option>
      <option value="&month=2">2月</option>
      <option value="&month=3">3月</option>
      <option value="&month=4">4月</option>
      <option value="&month=5">5月</option>
      <option value="&month=6">6月</option>
      <option value="&month=7">7月</option>
      <option value="&month=8">8月</option>
      <option value="&month=9">9月</option>
      <option value="&month=10">10月</option>
      <option value="&month=11">11月</option>
      <option value="&month=12">12月</option>
   </select>
   <script>
      function showCalender() {
         var yearSelect = document.getElementById("yearSelect").value;
         var monthSelect = document.getElementById("monthSelect").value;
         let ymSelect = yearSelect + monthSelect;
         location.href = ymSelect;
      }
      document.getElementById("yearSelect").querySelector("option[value='/?year={{ $year }}']").setAttribute("selected", "selected");
      document.getElementById("monthSelect").querySelector("option[value='&month={{ $month }}']").setAttribute("selected", "selected");
   </script>
</div>
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="calendar_create">
               @foreach ($calendar as $hoge)
               　{{ $hoge->getTitle() }}
               　{!! $hoge->render() !!}
               @endforeach
           </div>
       </div>
   </div>
</div>
@endsection