@extends('layouts.common')

@section('common')
<div>
 <div>
  <h5 class="titlebox username">内容を更新しますか？</h5>    
  <div>
    <form action="{{ route('update', ['id' => $form['id']]) }}" method="POST">
    @csrf
      <table class="edittable">
        <tr>
          <th>日付</th>
          <td>
            <input class="editipt editday" type="text" name="day" value="{{ $form['day'] }}">
          </td>
        </tr>
        <tr>
          <th>勤務開始</th>
          <td>
            <input class="editipt editwork" type="time" name="start_work" value="{{$form['start_work']}}">
          </td>
        </tr>
        <tr>
          <th>勤務終了</th>
          <td>
            <input class="editipt editwork" type="time" name="end_work" value="{{$form['end_work']}}">
          </td>
        </tr>
      </table>
      <div class="editbtn">
        <button type="submit" class="updatebtn">更新</button>
        <button type="button" onclick="history.back()" class="backbtn">戻る</button>
      </div>
    </form>
  </div>   
 </div>
</div>
@endsection