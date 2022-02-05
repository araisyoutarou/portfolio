@extends('layouts.app')
@section('content')
<div class="button">
   <button disabled>カレンダー</button>
   <button onclick="">円グラフ</button>
</div>

<h1 class="title">家計簿アプリ</h1>

<div class="years">
   <select name="year">
      <option value="未選択">選択してください</option>
      <option value="2022">2022年</option>
      <option value="2023">2023年</option>
      <option value="2024">2024年</option>
      <option value="2025">2025年</option>
      <option value="2026">2026年</option>
      <option value="2027">2027年</option>
      <option value="2028">2028年</option>
      <option value="2029">2029年</option>
      <option value="2030">2030年</option>
   </select>
</div>

<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               @foreach ($calendar as $hoge)
               　{{ $hoge->getTitle() }}
               　{!! $hoge->render() !!}
               @endforeach
           </div>
           
       </div>
   </div>
</div>
@endsection