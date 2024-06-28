@extends('layouts.common')

@section('common')
<div>
  <div>

    <h5 class="titlebox username">{{ Auth::user()->name }}さんの勤怠表</h5>
    
    <div class="d-flex justify-content-between mb-4">
      <form action="{{ route('individual') }}" method="get">
        <input type="hidden" name="date" value="{{ $previousMonth }}">
        <button type="submit" class="attebtn btn btn-primary attendancebutton"><</button>
      </form>
        <p class="carbonbox username">{{ Carbon\Carbon::createFromFormat('Y-m', $currentYearMonth)->format('Y年m月') }}</p>
      <form action="{{ route('individual') }}" method="get">
        <input type="hidden" name="date" value="{{ $nextMonth }}">
        <button type="submit" class="attebtn btn btn-primary attendancebutton">></button>
      </form>
      <form action="{{ route('individual') }}" method="get" class="calendar">
        <input class="calendarlabel" type="month" name="date" value="{{ $currentYearMonth }}">
        <button type="submit" class="attebtn individualbutton">表示</button>
      </form>
    </div>

    <table class="attetable">
      <tr class="attendancetable username">
        <th>日付</th>
        <th>勤務開始</th>
        <th>勤務終了</th>
        <th>休憩時間</th>
        <th>勤務時間</th>
      </tr>

      @foreach($workSummaries as $summary)
      <tr class="attendancebox username">
        <td>{{ $summary['day'] }}</td>
        <td>{{ $summary['start_work'] }}</td>
        <td>{{ $summary['end_work'] }}</td>
        <td>{{ $summary['breaktime'] }}</td>
        <td>{{ $summary['totalwork'] }}</td>
      </tr>
      @endforeach 
    </table>

    <div class="pagination">
      <p class="pagination">{{ $timestamps->appends(['date' => $currentYearMonth])->links() }}</p>
    </div>
    
  </div>
</div>

<!-- jQuery読み込み -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script>
    //更新処理モーダルの開閉処理
     $(function(){
        $("#modal-open").click(
	        function(){
    	    //キーボード操作などにより、オーバーレイが多重起動するのを防止する
          $(this).blur() ;	//ボタンからフォーカスを外す
          if($("#modal-overlay")[0]) return false ;		//新しくモーダルウィンドウを起動しない [下とどちらか選択]
          //if($("#modal-overlay")[0]) $("#modal-overlay").remove() ;		//現在のモーダルウィンドウを削除して新しく起動する [上とどちらか選択]

          //オーバーレイ用のHTMLコードを、[body]内の最後に生成する
          $("body").append('<div id="modal-overlay"></div>');

          //[$modal-overlay]をフェードインさせる
          $("#modal-overlay").fadeIn("slow");

          //[$modal-content]をフェードインさせる
          $("#modal-content").fadeIn("slow");
	        })
      });
  </script>
@endsection