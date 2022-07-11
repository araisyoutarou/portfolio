@extends('layouts.app')
@section('content')
<div class="title">
    <label>選択日付</label>
    <label class="date">{{ $date }}</label>
</div>
<div class="total">
    <label class="col-md-2" for="price">支出合計</label>
    <label class="prices">{{ $prices }}円</label>
</div>
<div class="block">
    <form action="{{ route('create_page') }}" method="post">
        <div class="textarea">
            <label class="col-md-2" for="price">支出</label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="price" maxlength="9" value="{{ old('price') }}" id="price">
            </div>
            <label class="col-md-2" for="spending">項目の選択</label>
            <div class="col-md-10">
                <select class="form-control" name="spending" value="{{ old('spending') }}" id="spending">
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
            <label class="col-md-2" for="diary">買い物メモ</label>
            <div class="col-md-10">
                <textarea class="form-control" name="diary" rows="15" maxlength="100" id="diary">{{ old('diary') }}</textarea>
            </div>
        </div>
        @csrf
        <input type="submit" class="btn btn-primary submit" value="登録" id="button1" onClick="return register()">
        <input type="submit" class="btn btn-primary submit" value="戻る" id="button2" onClick="back(); history.back(-1)">
        <input type="submit" class="btn btn-primary submit" value="収入登録" id="button3" onClick="income()">
        <input type="hidden" name="date" value="{{ $date }}">
    </form>
    <script>
        const price = document.getElementById('price');
        const spending = document.getElementById('spending');
        const diary = document.getElementById('diary');
        const button1 = document.getElementById('button1');
        const upd = document.getElementById('upd');
        const del = document.getElementById('del');

        const register = () =>{
            if(price.value.length == 0 || spending.value.length == 0 || diary.value.length == 0) {
                alert('『支出』 『項目』 『買い物メモ』全てに入力してください');
            } else {
                if (!window.confirm('登録してもよろしいですか？')){return false} 
            
            }
        };
        
        function back() {
          document.getElementById("button1").disabled = false;
          document.getElementById("button2").disabled = true;
          document.getElementById("button3").disabled = false;
        }
        
        function income() {
          document.getElementById("button1").disabled = false;
          document.getElementById("button2").disabled = false;
          document.getElementById("button3").disabled = true;
          var paramstr = document.location.search;
          document.location.href = "/calendar/income"+paramstr;
        }
        
        const upd_button = () =>{
            if (!window.confirm('更新してもよろしいですか？')){return false} 
        };
        
        const del_button = () =>{
            if (!window.confirm('削除してもよろしいですか？')){return false} 
        };
    </script>
    <form action="{{ route('update_delete_page') }}" method="post">
        <div class="history">
            <h2>支出履歴</h2>
            <table border="1" width="600">
                <tr>
                    <th>id</th>
                    <th>支出（円）</th>
                    <th>項目</th>
                    <th>買い物メモ</th>
                    <th>削除ボタン</th>
                @foreach ($books as $book)
                <tr>
                    <input type="hidden" name="id-{{ $book->id }}" value="{{ $book->id }}" >
                    <!--<input type="hidden" name="id[]" value="{{ $book->id }}" >-->
                    <td>{{ $book->id }}</td>
                    <td><input type="text" name="price-{{ $book->id }}" value={{ $book->price }}></td>
                    <!--<td><input type="text" name="price[]" value={{ $book->price }}></td>-->
                    <td><select name="spending-{{ $book->id }}">
                    <!--<td><select name="spending[]">-->
                        @foreach (config('select.select') as $select)
                        <option value="{{$select}}"@if($select==$book->spending) selected @endif>{{ $select }}</option>
                        @endforeach
                        </select>
                    </td>
                    <td><input type="text" name="diary-{{ $book->id }}" value={{ $book->diary }}></td>
                    <!--<td><input type="text" name="diary[]" value={{ $book->diary }}></td>-->
                    <td>
                        <input type="checkbox" name="delete-{{ $book->id }}"  class="btn btn-primary" value={{ $book->id }}>
                        <!--<input type="checkbox" name="delete[]"  class="btn btn-primary" value={{ $book->id }}>-->
                    </td>
                </tr>
                @endforeach
            </table>
            <input type="submit" name="upd_book"  class="btn btn-primary ud-submit" value="一括更新" id="upd" onClick="return upd_button()">
            <input type="submit" name="del_book"  class="btn btn-primary ud-submit" value="一括削除" id="del" onClick="return del_button()">
            <input type="hidden" name="date" value="{{ $date }}">
        </div>
        @csrf
    </form>
</div>

@endsection