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
          <th class="tableth">名前</th>
          <th class="tableth">メールアドレス</th>
        </tr>
        @foreach ($users as $user)
          <tr class="attendancebox">
            <td class="tabletd">{{ $user->name }}</td>
            <td class="tabletd">{{ $user->email }}</td>
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