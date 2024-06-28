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
  <div>
    <div>    
      <h5 class="titlebox username">ユーザーページ</h5>

      <table class="attetable username">
      <tr class="attendancetable">
        <th>名前</th>
        <th>メールアドレス</th>
      </tr>

      @foreach ($users as $user)
      <tr class="attendancebox">
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
      </tr> 
      @endforeach
      </table>

      <div class="pagination">
        <p class="pagination">{{ $users->links() }}</p>
      </div>    
    </div>
  </div>
</div >
@endsection