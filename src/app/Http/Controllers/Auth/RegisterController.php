<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers {
        // 登録後に自動ログインしないようにするために、traitのregisterメソッドをオーバーライドします
        register as traitRegister;
    }

    // このメソッドを追加して、登録後の処理をカスタマイズします
    public function register(Request $request)
    {
        $validator = $this->validator($request->all());
        $validator->validate();

        $user = $this->create($request->all());

        // 登録後に自動ログインしないようにするために、ログイン処理を削除します
        // $this->guard()->login($user);

        // ユーザーにメール送信（通知）を行う
        $user->sendEmailVerificationNotification();

        return redirect('/login')->with('status', '登録が完了しました。登録したメールアドレスに届いたリンクをクリックしてログインしてください。');
    }

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    // ユーザーが登録された後の処理
    // protected function registered(Request $request, $user)
    // {
    //     Mail::to($user->email)->send(new WelcomeMail($user));
    // }
}
