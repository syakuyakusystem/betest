@extends('layouts.common')

@section('common')
<div>
 <div>

  <h5 class="titlebox">{{ Auth::user()->name }}さんの勤怠表</h5>
    
 <div class="d-flex justify-content-between mb-4">
      <form action="{{ route('individual') }}" method="get">
        <input type="hidden" name="date" value="{{ $previousMonth }}">
        <button type="submit" class="btn btn-primary attendancebutton"><</button>
      </form>
        <p class="carbonbox">{{ Carbon\Carbon::createFromFormat('Y-m', $currentYearMonth)->format('Y年m月') }}</p>
      <form action="{{ route('individual') }}" method="get">
        <input type="hidden" name="date" value="{{ $nextMonth }}">
        <button type="submit" class="btn btn-primary attendancebutton">></button>
      </form>
    </div>


 <table>
      <tr class="attendancetable">
        <th>日付</th>
        <th>勤務開始</th>
        <th>勤務終了</th>
        <th>休憩時間</th>
        <th>勤務時間</th>
      </tr>

      @foreach($workSummaries as $summary)
      <tr class="attendancebox">
        <td>{{ $summary['day'] }}</td>
        <td>{{ $summary['start_work'] }}</td>
        <td>{{ $summary['end_work'] }}</td>
        <td>{{ $summary['breaktime'] }}</td>
        <td>{{ $summary['totalwork'] }}</td>
      </tr>
    @endforeach 
    </table>

    <div class="pagination">
      <!-- 月ごとにページネーション -->
      <p class="pagination">{{ $timestamps->appends(['date' => $currentYearMonth])->links() }}</p>
    </div>
    
 </div>
</div>

@endsection