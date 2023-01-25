<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{

    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

   // Line login
   public function redirectToLine(Request $request)
   {
       return Socialite::driver('line')->redirect();
   }

// Line callback
    public function handleLineCallback(Request $request)
    {
    // $user = Socialite::driver('line')->user();

    try {
        $user = Socialite::driver('line')->user();
    } catch (InvalidStateException $e) {
        $user = Socialite::driver('line')->stateless()->user();
    }

    echo "<pre>";
    print_r($user);
    echo "<pre>";
    exit();

    $value = $request->session()->get('redirectTo');
    $request->session()->forget('redirectTo');

    return redirect()->intended($value);

}




    //Register or Login
    protected function _registerOrLoginUser($data, $provider)
    {
        //GET USER
        $user = User::where('email', $data->email)->first();

        //Create if not exists
        if (!$user) {
            //CREATE NEW USER
            $user = new User();
            $user->name = $data->name;
            $user->provider_id = $data->id;
            $user->provider = $data->provider;
            $user->email = empty($data->email)?"":$data->email;
            $user->avatar = empty($data->avatar)?"":$data->avatar;
            $user->save();
        }
        //LOGIN by object user
        Auth::login($user);
    }
}
