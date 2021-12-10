<?php

namespace App\Http\Controllers;
use DB;
use Str;
use Auth;
use File;
use Helper;

use App\Models\Division;
use App\Models\District;
use App\Models\Upazila;
use App\User;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $data['usersData'] = User::join('division', 'division.id', '=', 'users.division')
            ->join('district', 'district.id', '=', 'users.district' )
            ->join('upazila', 'upazila.id', '=', 'users.upazila' )
            ->select('users.id', 'users.name', 'users.email', 'users.created_at', 'division.division_name', 'district.district_name', 'upazila.upazila_name')
            ->where('users.is_admin', 0)
            ->paginate(5);

        $data['divisions'] = Division::get();

        return view('home', $data);
    }

    public function userDataAjax(Request $request){
        if($request->ajax()){

            $sort_by = $request->get('sortby');
            $sort_type = $request->get('sorttype');
            $userSearchName = $request->get('userSearchName');
            $userSearchEmail = $request->get('userSearchEmail');
            $userSearchDivision = $request->get('userSearchDivision');
            $userSearchDistrict = $request->get('userSearchDistrict');
            $userSearchUpazila = $request->get('userSearchUpazila');


            $data['usersData'] = User::join('division', 'division.id', '=', 'users.division')
            ->join('district', 'district.id', '=', 'users.district' )
            ->join('upazila', 'upazila.id', '=', 'users.upazila' )
            ->select('users.id', 'users.name', 'users.email', 'users.created_at', 'division.division_name', 'district.district_name', 'upazila.upazila_name')
            ->where('users.is_admin', 0)
            ->where(function($query) use ($userSearchName, $userSearchEmail, $userSearchDivision, $userSearchDistrict, $userSearchUpazila)
            {
                $query->where('users.name', 'LIKE', '%'.$userSearchName.'%')
                    ->where('users.email', 'LIKE', '%'.$userSearchEmail.'%')
                    ->where('users.division', 'LIKE', '%'.$userSearchDivision.'%')
                    ->where('users.district', 'LIKE', '%'.$userSearchDistrict.'%')
                    ->where('users.upazila', 'LIKE', '%'.$userSearchUpazila.'%');

            })
            ->orderBy($sort_by, $sort_type)
            ->paginate(5);

            return view('user-data', $data);
        }
    }

    public function getDivisionHome(Request $request){
        $divisionId = $request->divisionId;
        $division = District::where('division_id', $divisionId)->pluck('district_name','id');
        return json_encode($division);
    }

    public function getDistrictHome(Request $request){
        $districtId = $request->districtId;
        $district = Upazila::where('district_id', $districtId)->pluck('upazila_name','id');
        return json_encode($district);
    }
}
