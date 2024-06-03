@extends('layouts.app')

@section('content')
<div class="container">
 <div class="attendance">
    <p>ここに月の表示</p>
    
    <table>
      <tr>
        <th>名前</th>
        <th>勤務開始</th>
        <th>勤務終了</th>
        <th>休憩時間</th>
        <th>勤務時間</th>
      </tr>
 @foreach($workSummaries as $summary)
      <tr>
        <td>
          <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
          {{ Auth::user()->name }}
          </a>
        </td>
        <td>{{ $summary['day'] }}</td>
        <td>b</td>
        <td>d/td>
        <td>e</td>
      </tr>
 @endforeach
    </table>

    <p>ページネーション</p>
 </div>
</div>




@endsection

