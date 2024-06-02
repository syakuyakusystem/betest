@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">

      <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
          {{ Auth::user()->name }}さんお疲れ様です！
      </a>
     
      <table>       
        <tr>
         <th>
          <form class="time-form" action="{{ route('work') }}" method="post">
           @csrf
            <div class="card">
             <div class="card-body">
               @if($status == 0)
                <button class="time-form__button-submit" type="submit" name="start_work">勤務開始</button>
               @else
                <button class="time-form__button-submit" type="submit" name="start_work" disabled>勤務開始</button>
               @endif
             </div>
            </div>
           </form>
         </th>

         <th>
          <form class="time-form" action="" method="post">
            @csrf
            <div class="card">
             <div class="card-body">
               @if($status == 1)
                <button class="time-form__button-submit" type="submit" name="end_work">勤務終了</button>
               @else
                <button class="time-form__button-submit" type="submit" name="end_work" disabled>勤務終了</button>
               @endif
             </div>
            </div>
           </form>
         </th>
        </tr>

        <tr>
         <td>
          <form class="time-form" action="" method="post">
            @csrf
            <div class="card">
             <div class="card-body">
        
                <button class="time-form__button-submit" type="submit" name="start_break">休憩開始</button>
    
                <button class="time-form__button-submit" type="submit" name="start_break" disabled>休憩開始</button>
        
             </div>
            </div>
           </form>
         </td>

         <td>
          <form class="time-form" action="" method="post">
            @csrf
            <div class="card">
             <div class="card-body">
             
                <button class="time-form__button-submit" type="submit" name="end_break">休憩終了</button>
          
                <button class="time-form__button-submit" type="submit" name="end_break" disabled>休憩終了</button>
         
             </div>
            </div>
           </form>
         </td>
        </tr>
      </table> 
    </div>      
  </div>
</div>
@endsection


