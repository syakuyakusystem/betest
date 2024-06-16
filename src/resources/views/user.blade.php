@extends('layouts.common')

@section('common')
<div>
 <div>
    
 <h5 class="titlebox">ユーザーページ</h5>


 <table>
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
@endsection