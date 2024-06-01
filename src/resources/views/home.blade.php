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
          <div class="card">
            <div class="card-body">
              <button>勤務開始</button>
            </div>
          </div>
         </th>
         <th>
          <div class="card">
            <div class="card-body">
              <button>勤務終了</button>
            </div>
          </div>
         </th>
        </tr>
        <tr>
         <td>
          <div class="card">
            <div class="card-body">
              <button>休憩開始</button>
            </div>
          </div>
         </td>
         <td>
          <div class="card">
            <div class="card-body">
              <button>休憩終了</button>
            </div>
          </div>
         </td>
        </tr>
      </table> 
    </div>      
  </div>
</div>
@endsection


