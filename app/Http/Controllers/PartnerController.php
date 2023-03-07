<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Ask_for_help;
use Illuminate\Support\Facades\Auth;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $partner = Partner::where('name', 'LIKE', "%$keyword%")
                ->orWhere('full_name', 'LIKE', "%$keyword%")
                ->orWhere('type', 'LIKE', "%$keyword%")
                ->orWhere('phone', 'LIKE', "%$keyword%")
                ->orWhere('mail', 'LIKE', "%$keyword%")
                ->orWhere('name_line_group', 'LIKE', "%$keyword%")
                ->orWhere('show_homepage', 'LIKE', "%$keyword%")
                ->orWhere('line_group_id', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $partner = Partner::latest()->paginate($perPage);
        }

        return view('partner.index', compact('partner'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('partner.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

        $requestData = $request->all();

        if ($request->hasFile('logo')) {
            $requestData['logo'] = $request->file('logo')->store('uploads', 'public');
        }
        Partner::create($requestData);

        return redirect('partner')->with('flash_message', 'Partner added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $partner = Partner::findOrFail($id);

        return view('partner.show', compact('partner'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $partner = Partner::findOrFail($id);

        return view('partner.edit', compact('partner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {

        $requestData = $request->all();

        if ($request->hasFile('logo')) {
            $requestData['logo'] = $request->file('logo')->store('uploads', 'public');
        }

        $partner = Partner::findOrFail($id);
        $partner->update($requestData);

        return redirect('partner')->with('flash_message', 'Partner updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Partner::destroy($id);

        return redirect('partner')->with('flash_message', 'Partner deleted!');
    }

    public function view_sos(Request $request)
    {
        $name_area = $request->get('name_area');

        $data_user = Auth::user();
        $data_partner = Partner::where("name", $data_user->organization)->first();

        $search_area = $data_partner->name ;
        $type_partner = $data_partner->type ;

        $perPage = 20;

        $sos_all_request = Ask_for_help::selectRaw('count(id) as count')->get();
            foreach ($sos_all_request as $key) {
                    $sos_all = $key->count ;
                }

        // นับจำนวนทั้งหมด
        $view_maps_all = DB::table('ask_for_helps')->get();

        $count_data = count($view_maps_all);
        ////////

        $view_maps = Ask_for_help::latest()->paginate($perPage);


        $select_name_areas = DB::table('ask_for_helps')
            ->get();

        $text_at = '@' ;

        // $data_time_zone = Time_zone::groupBy('TimeZone')->orderBy('CountryCode' , 'ASC')->get();

        $average_per_minute = $this->average_per_minute($view_maps_all);

        return view('partner.partner_sos', compact('data_partner','view_maps' , 'view_maps_all' , 'sos_all' ,'text_at','count_data', 'select_name_areas' , 'name_area' , 'average_per_minute','type_partner'));
    }

    public function average_per_minute($view_maps_all)
    {

        $minute_all = 0 ;
        $count_case = 0 ;
        $data_average = [] ;

        foreach ($view_maps_all as $item) {

            if(!empty($item->created_at) && !empty($item->help_complete_time)){
                $minute_row = \Carbon\Carbon::parse($item->help_complete_time)->diffinMinutes(\Carbon\Carbon::parse($item->created_at)) ;

                $count_case = $count_case + 1 ;

            }else{
                $minute_row = 0 ;
            }

            $minute_all = $minute_all + (int)$minute_row ;

            if($count_case != 0){
              $minute_per_case = $minute_all / $count_case ;
            }else{
              $minute_per_case = 0 ;
            }

        }

        if (!empty($minute_per_case)) {
            //  วัน
            $data_day = (int)$minute_per_case / 1440 ;
            $data_day_sp = explode("." , $data_day) ;
            $data_average['day'] = $data_day_sp[0] ;

            // ชม.
            $data_hr = (int)$minute_per_case / 60 - ($data_average['day'] * 24) ;
            $data_hr_sp = explode("." , $data_hr) ;
            $data_average['hr'] = $data_hr_sp[0] ;

            // นาที
            if (!empty($data_hr_sp[1])) {
                $data_min_1 = "0." . $data_hr_sp[1] ;
                $data_min_2 = (float)$data_min_1 * 60 ;
                $data_average['min'] = (int)$data_min_2 ;
            }else{
                $data_average['min'] = 0 ;
            }

            // เคส
            $data_average['count_case'] = $count_case ;
        }


        // echo "เวลาทั้งหมด : " . $minute_all;
        // echo "<br>";
        // echo "เคสช่วยเสร็จ : " . $count_case;
        // echo "<br>";
        // echo "นาทีเฉลี่ยต่อเคส : " . $minute_per_case;
        // echo "<br>";
        // echo "<--------------------------------->";
        // echo "<br>";

        // echo "data_average : " . $data_average['day'];
        // echo "<br>";

        // echo "data_average : " . $data_average['hr'];
        // echo "<br>";

        // echo "data_average : " . $data_average['min'];
        // echo "<br>";

        // echo "<pre>";
        // print_r($view_maps);
        // echo "<pre>";
        // exit();

        return $data_average ;
    }
}
