<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Tambon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $id = Auth::id();
        $user = User::findOrFail($id);


        return view('profile.profile_index' , compact('user'));
    }

    public function edit(Request $request,$id)
    {



        if (Auth::id()  == $id){

            $user = User::findOrFail($id);


                $provinces = Tambon::select('province')->distinct()->get();
                $amphoes = Tambon::select('amphoe')->distinct()->get();
                $tambons = Tambon::select('tambon')->distinct()->get();



            return view('profile.profile_edit', compact('user','provinces','amphoes','tambons'));

         }else{
            return view('404');
         }

    }

    public function update(Request $request,$id)
    {

            $requestData = $request->all();

            if ($request->hasFile('photo')) {
                $requestData['photo'] = $request->file('photo')->store('uploads', 'public');
            }

            if ($request->hasFile('health_card_1')) {
                $requestData['health_card_1'] = $request->file('health_card_1')->store('uploads', 'public');
            }
            if ($request->hasFile('health_card_2')) {
                $requestData['health_card_2'] = $request->file('health_card_2')->store('uploads', 'public');
            }
            if ($request->hasFile('health_card_3')) {
                $requestData['health_card_3'] = $request->file('health_card_3')->store('uploads', 'public');
            }

            $user = User::findOrFail($id);
            $user->update($requestData);

            $backurl = url()->previous();
            $register = url("/profile". "/" .$user->id. "/register");

            // echo "<pre>";
            // print_r($backurl);
            // echo "<pre>";
            // exit();

            if($backurl == $register){
                return redirect('/')->with('flash_message', 'Crud updated!');
            }else{
                return redirect('profile')->with('flash_message', 'Crud updated!');
            }

    }

    public function register(Request $request)
    {
        $id = Auth::id();
        $user = User::findOrFail($id);

        $provinces = Tambon::select('province')->distinct()->get();
        $amphoes = Tambon::select('amphoe')->distinct()->get();
        $tambons = Tambon::select('tambon')->distinct()->get();

        return view('profile.profile_register' , compact('user','provinces','amphoes','tambons'));
    }

    public function check_login(Request $request){

        if(Auth::check()){
            return redirect('profile');
        }else{
            return redirect('/login/line?redirectTo=profile');
        }

    }

    public function location_map_user(Request $request,$id){

        $user = User::findOrFail($id);

        return $user;
    }



}
