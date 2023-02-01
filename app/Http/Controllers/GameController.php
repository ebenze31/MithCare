<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{

    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 9;


        if (!empty($keyword)) {
            $game = Game::where('name', 'LIKE', "%$keyword%")
                ->orderBy('amount_click','desc')->paginate($perPage);
        } else {
            $game = Game::orderBy('amount_click','desc')->paginate($perPage);
        }

        return view('game.index', compact('game'));
    }


    public function create()
    {
        return view('game.create');
    }

    public function store(Request $request)
    {

        $requestData = $request->all();

        if ($request->hasFile('img')) {
            $requestData['img'] = $request->file('img')->store('uploads', 'public');
        }

        Game::create($requestData);

        return redirect('game')->with('flash_message', 'Game added!');
    }


    public function show($id)
    {
        $game = Game::findOrFail($id);

        return view('game.show', compact('game'));
    }


    public function edit($id)
    {
        $game = Game::findOrFail($id);

        return view('game.edit', compact('game'));
    }


    public function update(Request $request, $id)
    {

        $requestData = $request->all();


        if ($request->hasFile('img')) {
            $requestData['img'] = $request->file('img')->store('uploads', 'public');
        }

        $game = Game::findOrFail($id);
        $game->update($requestData);

        return redirect('game')->with('flash_message', 'Game updated!');
    }


    public function destroy($id)
    {
        Game::destroy($id);

        return redirect('game');
    }

    public function check_login(Request $request){

        if(Auth::check()){
            return redirect('game');
        }else{
            return redirect('/login/line?redirectTo=game');
        }

    }
}
