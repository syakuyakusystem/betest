@extends('layouts.app')

@section('content')
<div class="container">
 <div class="attendance">
    <div class="d-flex justify-content-between mb-4">
      <form action="{{ route('attendance') }}" method="get">
        <input type="hidden" name="date" value="{{ $previousDate }}">
        <button type="submit" class="btn btn-primary"><</button>
      </form>
        <p class="carbonbox">{{ Carbon\Carbon::createFromFormat('Y-m-d', $currentDate)->format('Y-m-d') }}</p>
      <form action="{{ route('attendance') }}" method="get">
        <input type="hidden" name="date" value="{{ $nextDate }}">
        <button type="submit" class="btn btn-primary">></button>
      </form>
    </div>
          
    <table>
      <tr class="attendancetable">
        <th>名前</th>
        <th>勤務開始</th>
        <th>勤務終了</th>
        <th>休憩時間</th>
        <th>勤務時間</th>
      </tr>
 @foreach($workSummaries as $summary)
      <tr class="attendancebox">
        <td>{{ $summary['user'] }}</td>
        <td>{{ $summary['start_work'] }}</td>
        <td>{{ $summary['end_work'] }}</td>
        <td>{{ $summary['totalbreak'] }}</td>
        <td>{{ $summary['totalwork'] }}</td>
      </tr>
 @endforeach
    </table>

    <div class="pagination">
      <p class="pagination">{{ $timestamps->links() }}</p>
    </div>
 </div>
</div>




@endsection

