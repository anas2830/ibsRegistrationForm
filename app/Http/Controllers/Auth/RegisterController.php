<?php

namespace App\Http\Controllers\Auth;

use DB;
use Str;
use Auth;
use File;
use Helper;


use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use App\Models\Division;
use App\Models\District;
use App\Models\Upazila;
use App\Models\UserEducation;
use App\Models\UserTraining;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */

    public function showRegistrationForm(){

        $data['divisions'] = Division::get();

        return view('auth.register', $data);
    }

    public function getDivision(Request $request){

        $divisionId = $request->divisionId;
        $division = District::where('division_id', $divisionId)->pluck('district_name','id');
        return json_encode($division);
    }

    public function getDistrict(Request $request){
        $districtId = $request->districtId;

        $district = Upazila::where('district_id', $districtId)->pluck('upazila_name','id');
        return json_encode($district);
    }


    public function signUp(Request $request){

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'language' => ['required']
        ]);

        $name = $request->name;
        $email = $request->email;
        $password = $request->password;
        $address  = $request->address;
        $language = $request->language;
        $division = $request->division;
        $district = $request->district;
        $upazila = $request->upazila;
        $training = $request->training;

        $photoFile = $request->photo;
        $attachmentFile = $request->attachment;
        $photo_name = Null;
        $photo_original_name = Null;
        $photo_size = Null;
        $photo_extention = Null;
        if(isset($photoFile)){
            $validPath = 'uploads/assignment';
            $uploadResponse = Helper::getUploadedFileName($photoFile, $validPath);
            if($uploadResponse['status'] == 1){
                $photo_name = $uploadResponse['file_name'];
                $photo_original_name = $uploadResponse['file_original_name'];
                $photo_size = $uploadResponse['file_size'];
                $photo_extention = $uploadResponse['file_extention'];
            }else{
                $output['messege'] = $uploadResponse['errors'];
                $output['msgtype'] = 'danger';
                return response()->json($output);
            } 
        }

        $attachment_name = Null;
        $attachment_original_name = Null;
        $attachment_size = Null;
        $attachment_extention = Null;
        if(isset($attachmentFile)){
            $validPath = 'uploads/assignment/attachment';
            $uploadAttachResponse = Helper::getUploadedAttachmentName($attachmentFile, $validPath);
            if($uploadAttachResponse['status'] == 1){

                $attachment_name = $uploadAttachResponse['file_name'];
                $attachment_original_name = $uploadAttachResponse['file_original_name'];
                $attachment_size = $uploadAttachResponse['file_size'];
                $attachment_extention = $uploadAttachResponse['file_extention'];
                
            }else{

                $output['messege'] = $uploadAttachResponse['errors'];
                $output['msgtype'] = 'danger';
                return response()->json($output);
            } 
        }

        $userMaster = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'address' => $address,
            'language' => json_encode($language),
            'photo_name' => $photo_name,
            'photo_original_name' => $photo_original_name,
            'photo_size' => $photo_size,
            'photo_extention' => $photo_extention,
            'attachment_name' => $attachment_name,
            'attachment_original_name' => $attachment_original_name,
            'attachment_size' => $attachment_size,
            'attachment_extention' => $attachment_extention,
            'division' => $division,
            'district' => $district,
            'upazila' => $upazila,
            'is_training' => $training,

        ]);

        $user_id = $userMaster->id;

        $input_exams   = $request->exam_name;
        $input_university = $request->university;
        $input_board = $request->board;
        $input_result = $request->result;
        $filter_exam_name = array_filter($input_exams);
        if(!empty($input_exams)) {
            foreach($filter_exam_name as $key => $exam_name) {
                UserEducation::create([
                    'user_id'           => $user_id,
                    'exam_name'         => $exam_name,
                    'university'        => $input_university[$key],
                    'board'             => $input_board[$key],
                    'result'            => $input_result[$key]
                ]);
            }
        }

        if($training == 1){
            $input_training   = $request->training_name;
            $input_training_details = $request->training_details;
            $filter_training_name = array_filter($input_training);
            if(!empty($input_training)) {
                foreach($filter_training_name as $key => $training_name) {
                    UserTraining::create([
                        'user_id'           => $user_id,
                        'training_name'     => $training_name,
                        'training_details'  => $input_training_details[$key],
                    ]);
                }
            }
        }


        $output['messege'] = "Applicant Register successfully";
        $output['msgtype'] = 'success';

        return response()->json($output);
 

    }

}
