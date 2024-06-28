@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    @if (session('message'))
        <div class="alert alert-warning" role="alert">
            {{ session('message') }}
        </div>
    @endif
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div>
            <h4 class="hederbox">ログイン</h4>

            <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                @csrf

                    <div class="row mb-3 hederboxrow">
                      <div class="formbox">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror inputbox" name="email" value="{{ old('email') }}" autocomplete="email" autofocus placeholder="メールアドレス">
                        @error('email')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>
                    </div>

                    <div class="row mb-3 hederboxrow">
                      <div class="formbox">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror inputbox" name="password" autocomplete="current-password" placeholder="パスワード">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                    </div>

                    <!-- ログイン状態を保持するチェックボックス実装 -->
                    <div class="textlink username">
                      <div class="">
                        <div class="">
                            <input class="" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                              <label class="" for="remember">
                                {{ __('Remember Me') }}
                              </label>
                        </div>
                      </div>
                    </div>

                    <!-- パスワードを忘れた場合にメールで確認し再登録のリンク実装 -->
                    <div class="addbtn">
                        @if (Route::has('password.request'))
                          <a class="pwdlnk" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                          </a>
                        @endif
                    </div>

                    <!-- ログインボタン -->
                    <div class="addbtn">
                      <div>
                        <button type="submit" class="attebtn btn loginbtn underline">
                          {{ __('Login') }}
                        </button>                                
                      </div>

                      <p class="textlink username">アカウントをお持ちでない方はこちらから</p>
                        @if (Route::has('register'))
                          <div class="bluelink">
                            <a href="{{ route('register') }}" class="underline">会員登録</a>
                          </div>
                        @endif
                    </div>
                </form>
            </div>
        </div>
      </div>
    </div>
</div>
@endsection
