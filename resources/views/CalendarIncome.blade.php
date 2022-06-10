@extends('layouts.app')
@section('content')
<div class="title">
    <label class="date">{{ $date }}</label>
</div>
<div class="total">
    <label class="col-md-2" for="income">収入合計</label>
    <label class="prices">{{ $incomes }}円</label>
</div>
<div class="block">
    <form action="{{ route('create_income_page', ['id' => 1]) }}" method="post">
        <div class="textarea">
            <label class="col-md-2" for="income">収入</label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="income" value="{{ old('income') }}">
            </div>
            <label class="col-md-2" for="income_spending">項目の選択</label>
            <div class="col-md-10">
                <select class="form-control" name="income_spending" value="{{ old('income_spending') }}">
                    <option value="未選択">選択してください</option>
                    <option value="給料">給料</option>
                    <option value="賞与">賞与</option>
                    <option value="臨時収入">臨時収入</option>
                    <option value="その他">その他</option>
                </select>
            </div>
            <label class="col-md-2" for="income_diary">収支メモ</label>
            <div class="col-md-10">
                <textarea class="form-control" name="income_diary" rows="15">{{ old('income_diary') }}</textarea>
            </div>
        </div>
        @csrf
        <input type="submit" class="btn btn-primary submit" value="登録" id="button1">
        <input type="submit" class="btn btn-primary submit" value="戻る" id="button2" onclick="back();history.back(-1)">
        <input type="submit" class="btn btn-primary submit" value="支出登録" id="button3" onclick="price()">
        <input type="hidden" name="date" value="{{ $date }}">
    </form>
    <script>
        function back() {
          document.getElementById("button1").disabled = false;
          document.getElementById("button2").disabled = true;
          document.getElementById("button3").disabled = false;
        }
        function price() {
          document.getElementById("button1").disabled = false;
          document.getElementById("button2").disabled = false;
          document.getElementById("button3").disabled = true;
          var paramstr = document.location.search;
          document.location.href = "/calendar/memo"+paramstr;
        }
    </script>
    <script>
    function confirm_test() {
        var select = confirm("登録完了");
        return select;
    }
    </script>
    <form action="{{ route('update_income_page') }}" method="post" onsubmit="return confirm_test()">
        <div class="history">
            <table border="1" width="600">
                <tr>
                    <th>id</th>
                    <th>収入（円）</th>
                    <th>項目</th>
                    <th>収支メモ</th>
                    <th>削除ボタン</th>
                </tr>
                @foreach ($income_books as $income)
                <tr>
                    <input type="hidden" name="income_id-{{ $income->income_id }}" value="{{ $income->income_id }}" >
                    <td>{{ $income->income_id }}</td>
                    <td><input type="text" name="income-{{ $income->income_id }}" value={{ $income->income }}></td>
                    <td><select name="income_spending-{{ $income->income_id }}">
                        @foreach (config('income_select.income_select') as $income_select)
                        <option value="{{$income_select}}"@if($income_select==$income->income_spending) selected @endif>{{ $income_select }}</option>
                        @endforeach
                        </select>
                    </td>
                    <td><input type="text" name="income_diary-{{ $income->income_id }}" value={{ $income->income_diary }}></td>
                    <td>
                        <input type="checkbox" name="income_delete-{{ $income->income_id }}"  class="btn btn-primary" value={{ $income->income_id }} >
                    </td>
                </tr>
                @endforeach
            </table>
            <input type="submit" name="upd_income"  class="btn btn-primary ud-submit" value="一括更新" >
            <input type="submit" name="del_income"  class="btn btn-primary ud-submit" value="一括削除" >
            <input type="hidden" name="date" value="{{ $date }}">
        </div>
        @csrf
    </form>    
</div>

@endsection