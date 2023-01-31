<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Revolution\Line\Facades\Bot;
use Redirect;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function redirectTo()
    {
        // if(!isset($_SESSION["backurl"]) )
        //     $_SESSION["backurl"] = $_SERVER['HTTP_REFERER'] ;
        //     $backurl = $_SESSION["backurl"];
        //     // echo "backurl >> ". parse_url($backurl, PHP_URL_QUERY);
        //     // exit();

        $backurl = $_SERVER['HTTP_REFERER'] ;

        $redirectTo = parse_url($backurl, PHP_URL_QUERY);

        if (!empty($redirectTo)) {
            $backurl_split = explode('redirectTo=', $redirectTo, 2);
            $back = $backurl_split[1];
            return $back;
        }else{
            return $backurl;
        }

    }

   // Line login
   public function redirectToLine(Request $request)
   {
        $request->session()->put('redirectTo', $request->get('redirectTo'));

        return Socialite::driver('line')->redirect();
   }

// Line callback
    public function handleLineCallback(Request $request)
    {
    $user = Socialite::driver('line')->user();

    // try {
    //     $user = Socialite::driver('line')->user();
    // }
    // catch (InvalidStateException $e) {
    //     $user = Socialite::driver('line')->stateless()->user();
    // }

    // echo "<pre>";
    // print_r($user);
    // echo "<pre>";
    // exit();

    $this->_registerOrLoginUser($user);

    $value = $request->session()->get('redirectTo');
    $request->session()->forget('redirectTo');

    return redirect()->intended($value);

}

    //Register or Login
    protected function _registerOrLoginUser($data)
    {
        //GET USER
        $user = User::where('provider_id', $data->id)->first();

        //Create if not exists
        if (!$user) {
            //CREATE NEW USER
            $user = new User();
            $user->name = $data->name;
            $user->username = $data->name;
            $user->provider_id = $data->id;
            $user->status = "active";
            if (!empty($data->email)) {
                $user->email = $data->email;
            }

            if (empty($data->email)) {
                $user->email = "กรุณาเพิ่มอีเมล";
            }

            // AVATAR
            if (!empty($data->avatar)) {
                $user->avatar = $data->avatar;

                $url = $data->avatar;
                $img = storage_path("app/public")."/uploads". "/" . 'photo' . $data->id . '.png';
                // Save image
                file_put_contents($img, file_get_contents($url));
                $user->photo = "uploads". "/" . 'photo' . $data->id . '.png';
            }
            else if (empty($data->avatar)) {
                $user->avatar = "กรุณาเพิ่มรูปโปรไฟล์";
                $user->photo = null ;
            }

            $user->save();
        }
        //LOGIN by object user
        Auth::login($user);
    }
}
