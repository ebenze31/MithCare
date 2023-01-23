<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Game;
class GameController extends Controller
{
    public function update_Click(Request $request)
    {
         $game_id = $request->get('from_click');


        // echo"<pre>";
        // print_r($requestData);
        // echo"</pre>";
        // return $requestData;

        $game = Game::where('id',$game_id)->first();

        if(empty($game->amount_click)){
            $amount = 1;
        }else{
            $amount = (int)$game->amount_click + 1;
        }


         DB::table('games')
              ->where('id', $game_id)
              ->update(['amount_click' => $amount]);

        return $amount;
    }

}
