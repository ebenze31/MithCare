<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Tambon;
class TambonController extends Controller
{
    public function getProvinces()
    {
        $provinces = Tambon::select('province')
            ->distinct()
            ->get();
        return $provinces;
    }
    public function getAmphoes($province)
    {  
        return $province;
        $amphoes = DB::table('lat_longs')
            ->select('amphoe_th')
            ->where('changwat_th', 'like', "%$province%")
            ->groupBy('amphoe_th')
            ->orderBy('amphoe_th','asc')
            ->get();

            echo"<pre>";

            print_r($amphoes);

            echo"<pre>";

            exit();
        return $amphoes;
    }
    public function getTambons(Request $request)
    {
        $province = $request->get('province');
        $amphoe = $request->get('amphoe');
        $tambons = Tambon::select('tambon')
            ->where('province', 'like', "%$province%")
            ->where('amphoe', 'like', "%$amphoe%")
            ->distinct()
            ->get();
        return $tambons;
    }
    public function getZipcodes(Request $request)
    {
        $province = $request->get('province');
        $amphoe = $request->get('amphoe');
        $tambon = $request->get('tambon');
        $zipcodes = Tambon::select('zipcode')
            ->where('province', $province)
            ->where('amphoe', $amphoe)
            ->where('tambon', $tambon)
            ->get();
        return $zipcodes;
    }
}