@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div>
                <h4 class="hederbox">会員登録</h4>

                <div class="card-body postbody">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3 hederboxrow">
                            <div class="formbox hederboxrow">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror inputbox" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="名前">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3 hederboxrow">
                            <div class="formbox hederboxrow">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror inputbox" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="メールアドレス">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3 hederboxrow">
                            <div class="formbox hederboxrow">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror inputbox" name="password" required autocomplete="new-password" placeholder="パスワード">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3 hederboxrow">
                            <div class="formbox hederboxrow">
                                <input id="password-confirm" type="password" class="form-control inputbox" name="password_confirmation" required autocomplete="new-password" placeholder="確認用パスワード">
                            </div>
                        </div>

                        <div class="addbtn">
                            <div>
                                <button type="submit" class="btn btn-primary underline">
                                    会員登録
                                </button>
                            </div>
                        </div>

                        <div>
                          <p class="textlink">アカウントをお持ちの方はこちらから</p>
                          @if (Route::has('login'))
                          <div class="bluelink">
                            <a href="{{ route('login') }}" class="underline">ログイン</a>
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
