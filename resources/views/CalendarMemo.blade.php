@extends('layouts.CalendarMemo')
@section('content')
<h1 class="title">家計簿アプリ</h1>

<form action="{{ route('create_page', ['id' => 1]) }}" method="post">
<div class="form-group row">
    <label class="col-md-2" for="income">収入</label>
    <div class="col-md-10">
        <input type="text" class="form-control" name="income" value="{{ old('income') }}">
    </div>
</div>
<div class="form-group row">
    <label class="col-md-2" for="spending">項目の選択</label>
    <div class="col-md-10">
        <select class="form-control" name="spending" value="{{ old('spending') }}">
            <option value="未選択">選択してください</option>
            <option value="食費">食費</option>
            <option value="外食">外食</option>
            <option value="日用品">日用品</option>
            <option value="水道光熱費">水道光熱費</option>
            <option value="通信費">通信費</option>
            <option value="交通費">交通費</option>
            <option value="カード決済">カード決済</option>
            <option value="税金">税金</option>
            <option value="その他">その他</option>
        </select>
    </div>
</div>
<div class="form-group row">
    <label class="col-md-2" for="price">支出</label>
    <div class="col-md-10">
        <input type="text" class="form-control" name="price" value="{{ old('price') }}">
    </div>
</div>
<div class="form-group row">
    <label class="col-md-2" for="diary">買い物メモ</label>
    <div class="col-md-10">
        <textarea class="form-control" name="diary" rows="20">{{ $diary->diary }}</textarea>
    </div>
</div>
    @csrf
    <input type="submit" class="btn btn-primary" value="更新">
    <a href="{{ route('edit_page', ['id' => 1]) }}" role="button" class="btn btn-primary">編集</a>
</form>



@endsection