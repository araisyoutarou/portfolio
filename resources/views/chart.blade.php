@extends('layouts.app')
@section('content')

<div class="button">
   <button onclick="location.href='https:/'">カレンダー</button>
   <button disabled>円グラフ</button>
</div>
<h1 class="title">家計簿アプリ</h1>

<div class="content">
   <div>
      <canvas id="allChart"></canvas>
   </div>
   aaa
</div>



<script>
   id = 'allChart';
   labels = @json($keys);
   data = @json($counts);
   make_chart(id,labels,data);
</script>
@endsection