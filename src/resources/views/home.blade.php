@extends('layouts.common')

@section('common')
<div class="container area">
  <ul class="circles">
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
  </ul>

  <div class="row justify-content-center">
    <div class="col-md-8">

    <a id="navbarDropdown" class="nav-link username" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
      {{ Auth::user()->name }}さんお疲れ様です
    </a>
     
      <table class="attetable">       
        <tr>
         <th class="card-th">
          <form class="time-form" action="{{ route('work') }}" method="post">
           @csrf
            <div class="cardbox">
             <div class="card-bodybox">
               @if($status == 0)
                <button class="attebtn time-form__button-submit homebutton" type="submit" name="start_work">勤務開始</button>
               @else
                <button class="attebtn time-form__button-submit homebutton" type="submit" name="start_work" disabled>勤務開始</button>
               @endif
             </div>
            </div>
           </form>
         </th>

         <th class="card-th">
          <form class="time-form" action="{{ route('work') }}" method="post">
            @csrf
            <div class="cardbox">
             <div class="card-bodybox">
               @if($status == 1)
                <button class="attebtn time-form__button-submit homebutton" type="submit" name="end_work">勤務終了</button>
               @else
                <button class="attebtn time-form__button-submit homebutton" type="submit" name="end_work" disabled>勤務終了</button>
               @endif
             </div>
            </div>
           </form>
         </th>
        </tr>

        <tr>
         <td>
          <form class="time-form" action="{{ route('work') }}" method="post">
            @csrf
            <div class="cardbox">
             <div class="card-bodybox">
               @if($status == 1)
                <button class="attebtn time-form__button-submit homebutton" type="submit" name="start_break">休憩開始</button>
               @else
                <button class="attebtn time-form__button-submit homebutton" type="submit" name="start_break" disabled>休憩開始</button>
               @endif
             </div>
            </div>
           </form>
         </td>

         <td>
          <form class="time-form" action="{{ route('work') }}" method="post">
            @csrf
            <div class="cardbox">
             <div class="card-bodybox">
               @if($status == 2)
                <button class="attebtn time-form__button-submit homebutton" type="submit" name="end_break">休憩終了</button>
               @else
                <button class="attebtn time-form__button-submit homebutton" type="submit" name="end_break" disabled>休憩終了</button>
               @endif
             </div>
            </div>
           </form>
         </td>
        </tr>
      </table> 

    </div>      
  </div>
</div>
</div >
@endsection

