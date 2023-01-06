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
        
            $user = User::findOrFail($id);
            $user->update($requestData);

        return redirect('profile')->with('flash_message', 'Crud updated!');

                                      
    }



}
