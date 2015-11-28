<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Intervention\Image\ImageManagerStatic as Image;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */


    use AuthenticatesAndRegistersUsers, ThrottlesLogins;
    //注册后返回主页
    protected $redirectPath = '/articles';
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

     public function qq() {
        return \Socialite::with('qq')->redirect();
        // return \Socialite::with('weibo')->scopes(array('email'))->redirect();
    }

    public function callback() {
        $oauthUser = \Socialite::with('qq')->user();
        $user = User::firstOrCreate([
            'name' => $oauthUser->nickname,
            'email'=> $oauthUser->email,
        ]);
        if ($user->avatar == '/images/avatar/avatardefault.jpg'){
        Image::make($oauthUser->avatar)
            ->resize(100, 100)
            ->save(base_path() . '/public/images/avatar/avatar' . $user->id . '.jpg');
        Image::make($oauthUser->avatar)
            ->resize(31, 31)
            ->save(base_path() . '/public/images/avatar/30avatar' . $user->id . '.jpg');
        $user->avatar = '/images/avatar/avatar' . $user->id . '.jpg';
        $user->save();}
        Auth::login($user,true);
        return redirect('articles');
    }
}








