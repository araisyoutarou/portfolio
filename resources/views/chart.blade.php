@extends('layouts.app')
@section('content')
<div class="button">
   <button onclick="location.href='https:/'">カレンダー</button>
   <button disabled>円グラフ</button>
</div>
<h1 class="title">家計簿アプリ</h1>
<div class="years">
   <th>年を選択</th>
   <select id="yearSelect" name="year" onChange="showChart()"> 
      <option value="/chart/?year=2023">2023年</option>
      <option value="/chart/?year=2022">2022年</option>
      <option value="/chart/?year=2021">2021年</option>
      <option value="/chart/?year=2020">2020年</option>
      <option value="/chart/?year=2019">2019年</option>
      <option value="/chart/?year=2018">2018年</option>
   </select>
   <th>月を選択</th>
   <select id="monthSelect" name="month" onChange="showChart()">
      <option value="&month=year">年間</option>
      <option value="&month=01">1月</option>
      <option value="&month=02">2月</option>
      <option value="&month=03">3月</option>
      <option value="&month=04">4月</option>
      <option value="&month=05">5月</option>
      <option value="&month=06">6月</option>
      <option value="&month=07">7月</option>
      <option value="&month=08">8月</option>
      <option value="&month=09">9月</option>
      <option value="&month=10">10月</option>
      <option value="&month=11">11月</option>
      <option value="&month=12">12月</option>
   </select>
   <script>
      function showChart() {
         var yearSelect = document.getElementById("yearSelect").value;
         var monthSelect = document.getElementById("monthSelect").value;
         let ymSelect = yearSelect + monthSelect;
         location.href = ymSelect;
      }
      document.getElementById("yearSelect").querySelector("option[value='/chart/?year={{ $chartYear }}']").setAttribute("selected", "selected");
      document.getElementById("monthSelect").querySelector("option[value='&month={{ $chartMonth }}']").setAttribute("selected", "selected");
   </script>
   <div class="total">
      <label class="col-md-2" for="price">支出合計</label>
      <label class="prices">{{ $prices }}円</label>
      <label class="col-md-2" for="income">収入合計</label>
      <label class="prices">{{ $incomes }}円</label>
   </div>
   <div class="content">
      <div>
         <canvas class="allChart" id="allChart"></canvas>
      </div>
   </div>
</div>

<script>
   id = 'allChart';
   labels = @json($keys);
   data = @json($counts);
   make_chart(id,labels,data);
</script>

@endsection