<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\API\LineApiController;
use App\Models\User;

class LocationController extends Controller
{

    public function show_location_P()
    {
        $location_P = DB::table('lat_longs')
                        ->select('changwat_th')
                        ->groupBy('changwat_th')
                        ->orderBy('changwat_th', 'asc')
                        ->get();

        return $location_P;
    }

    public function show_location_A($province)
    {
        $location_A = DB::table('lat_longs')
                        ->select('amphoe_th')
                        ->where('changwat_th', $province)
                        ->groupBy('amphoe_th')
                        ->orderBy('amphoe_th', 'asc')
                        ->get();
        return $location_A;
    }

    public function show_location_T($province , $amphoe)
    {
        $location_T = DB::table('lat_longs')
                        ->select('tambon_th')
                        ->where('changwat_th', $province)
                        ->where('amphoe_th', $amphoe)
                        ->groupBy('tambon_th')
                        ->orderBy('tambon_th', 'asc')
                        ->get();
        return $location_T;
    }

    public function show_location_latlng($province , $amphoe , $tambon)
    {
        $latlng = DB::table('lat_longs')
                    ->where('changwat_th','LIKE', "%$province%")
                    ->where('amphoe_th', 'LIKE',"%$amphoe%")
                    ->where('tambon_th','LIKE', "%$tambon%")
                    ->get();

        return $latlng;

    }

    function show_location_latlng_province($province)
    {
        $latlng = DB::table('lat_longs')
            ->where('changwat_th', $province)
            ->get();

        $i = 1 ;
        $lat = 0 ;
        $lng = 0 ;

        foreach ($latlng as $item) {

            $lat  = number_format($item->lat + $lat , 4, '.', '') ;
            $lng  = number_format($item->lng + $lng , 4, '.', '') ;

            $x_lat = number_format($lat / $i , 4, '.', '') ;
            $x_lng = number_format($lng / $i , 4, '.', '') ;


            $i = $i + 1 ;
        }


        $lat_lng_arr = array();

        $lat_lng_arr['lat'] = $x_lat ;
        $lat_lng_arr['lng'] = $x_lng ;

        return $lat_lng_arr;
    }

    function show_location_latlng_amphoe($province , $amphoe)
    {
        $latlng = DB::table('lat_longs')
            ->where('changwat_th', $province)
            ->where('amphoe_th', $amphoe)
            ->get();

        $i = 1 ;
        $lat = 0 ;
        $lng = 0 ;

        foreach ($latlng as $item) {

            $lat  = number_format($item->lat + $lat , 4, '.', '') ;
            $lng  = number_format($item->lng + $lng , 4, '.', '') ;

            $x_lat = number_format($lat / $i , 4, '.', '') ;
            $x_lng = number_format($lng / $i , 4, '.', '') ;


            $i = $i + 1 ;
        }


        $lat_lng_arr = array();

        $lat_lng_arr['lat'] = $x_lat ;
        $lat_lng_arr['lng'] = $x_lng ;

        return $lat_lng_arr;
    }

}
