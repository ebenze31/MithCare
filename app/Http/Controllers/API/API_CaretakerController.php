<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class API_CaretakerController extends Controller
{
    public function getCaretaker(Request $request)
    {
         $caretaker = $request->get('caretaker');



        return $caretaker;
    }

}
