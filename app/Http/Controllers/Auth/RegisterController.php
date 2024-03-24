<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\School;
use App\Models\SchoolGroup;
use App\Models\SchoolGroupRole;
use App\Models\SchoolLocation;
use App\Models\SchoolPosition;
use App\Models\SchoolShift;
use App\Models\SchoolShiftHour;
use App\Models\SchoolUser;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
    // protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = '/billing-invoice/choose-package';

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
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'step1_school_level'        => ['required', 'string', 'max:255'],
            'step2_school_name'         => ['required', 'string', 'max:255'],
            'step2_school_address'      => [],
            'step2_pic_name'            => ['required', 'string', 'max:255'],
            'step2_pic_email'           => ['required', 'string', 'max:255', 'unique:users,email'],
            'step2_pic_phone_number'    => ['required', 'string', 'max:255'],
            'step2_pic_password'        => ['required', 'string', 'max:255'],
            'step2_pic_address'             => [],
            'step3_title'               => ['required', 'string', 'max:255'],
            'step3_address'             => [],
            'step3_location'            => ['required', 'string', 'max:255'],
            'step3_radius_distance'     => ['required', 'string', 'max:255'],
            'step3_lat'                 => ['required', 'string', 'max:255'],
            'step3_long'                => ['required', 'string', 'max:255'],
            'step4_title'               => ['required', 'string', 'max:255'], // harus nya shift name
            'step4_time_tolerance'      => ['required', 'string', 'max:255'],
            'shift_hours.*.day'         => ['required'],
            'shift_hours.*.day'         => ['required'],
            'shift_hours.*.time_in'     => ['required'],
            'shift_hours.*.time_out'    => ['required'],
        ]);
    }

    protected function create(array $data)
    {
        try {
            DB::beginTransaction();

            // ==============================================================================================================================================================================
            // START CREATE SCHOOL
            // ==============================================================================================================================================================================
            $school = School::create([
                'active_billing_id' => null,
                'school_level'      => $data['step1_school_level'],
                'school_name'       => $data['step2_school_name'],
                'school_address'    => $data['step2_school_address'],
                'register_ref_code' => 'RANDOM',

                'pic_name'          => $data['step2_pic_name'],
                'pic_address'       => $data['step2_pic_address'],
                'pic_email'         => $data['step2_pic_email'],
                'pic_phone_number'  => $data['step2_pic_phone_number'],
            ]);
            // ==============================================================================================================================================================================
            // END CREATE SCHOOL
            // ==============================================================================================================================================================================

            // ==============================================================================================================================================================================
            // START CREATE SCHOOL LOCATION
            // ==============================================================================================================================================================================
            $location = SchoolLocation::create([
                'school_id'         => $school->id,
                'title'             => $data['step3_title'],
                'address'           => $data['step3_address'],
                'location'          => $data['step3_location'],
                'lat'               => $data['step3_lat'],
                'long'              => $data['step3_long'],
                'radius_distance'   => $data['step3_radius_distance'],
            ]);
            // ==============================================================================================================================================================================
            // END CREATE SCHOOL LOCATION
            // ==============================================================================================================================================================================

            // ==============================================================================================================================================================================
            // START CREATE SCHOOL SHIFT & HOUR
            // ==============================================================================================================================================================================
            $shift = SchoolShift::create([
                'school_id'         => $school->id,
                'shift_name'        => $data['step4_title'],
                'time_tolerance'    => $data['step4_time_tolerance'],
            ]);

            $days = [1=> 'Senin', 2 => 'Selasa', 3 => 'Rabu', 4 => 'Kamis', 5 => 'Jumat', 6 => 'Sabtu', 7 => 'Minggu'];
            $shift_hour = [];
            $h = $data['step4_school_shift'];
            foreach ($days as $day_in => $days) {
                $shift_hour[] = [
                    'school_shift_id' => $shift->id,
                    'school_id' => $school->id,
                    'day_in'    => $day_in,
                    'day'       => $h['day'][($day_in-1)],
                    'hour_in'   => $h['hour_in'][($day_in-1)],
                    'hour_out'  => $h['hour_out'][($day_in-1)],
                ];
            }
            SchoolShiftHour::insert($shift_hour);
            // ==============================================================================================================================================================================
            // END CREATE SCHOOL SHIFT & HOUR
            // ==============================================================================================================================================================================

            // ==============================================================================================================================================================================
            // START CREATE SCHOOL GROUP
            // ==============================================================================================================================================================================
            SchoolGroup::insert([
                [
                    'school_id'                 => $school->id,
                    'group_name'                => 'Karyawan',
                    'group_code'                => 'KR',
                    'school_shift_id'           => $shift->id,
                    'daily_presence_service_id' => 1,
                    'is_can_create_presence'    => 1,
                ],
                [
                    'school_id'                 => $school->id,
                    'group_name'                => 'Peserta Didik',
                    'group_code'                => 'PD',
                    'school_shift_id'           => $shift->id,
                    'daily_presence_service_id' => 1,
                    'is_can_create_presence'    => 0,
                ]
            ]);
            // ==============================================================================================================================================================================
            // END CREATE SCHOOL GROUP
            // ==============================================================================================================================================================================

            // ==============================================================================================================================================================================
            // START CREATE SCHOOL POSITION
            // ==============================================================================================================================================================================
            $positions = [
                [
                    'school_id'         => $school->id,
                    'position_code'     => 'Guru',
                    'position_name'     => 'Guru'
                ]
            ];
            if ($data['step1_school_level'] === 'SMP/MTs') {
                $positions[] = ['school_id' => $school->id, 'position_code' => 'KLS-VII', 'position_name' => 'Kelas VII/7'];
                $positions[] = ['school_id' => $school->id, 'position_code' => 'KLS-VIII', 'position_name' => 'Kelas VIII/8'];
                $positions[] = ['school_id' => $school->id, 'position_code' => 'KLS-IX', 'position_name' => 'Kelas IX/9'];
            } else if ($data['step1_school_level'] === 'SMA/SMK') {
                $positions[] = ['school_id' => $school->id, 'position_code' => 'KLS-X', 'position_name' => 'Kelas X/10'];
                $positions[] = ['school_id' => $school->id, 'position_code' => 'KLS-XI', 'position_name' => 'Kelas XI/11'];
                $positions[] = ['school_id' => $school->id, 'position_code' => 'KLS-XII', 'position_name' => 'Kelas XII/12'];
            }

            SchoolPosition::insert($positions);
            // ==============================================================================================================================================================================
            // END CREATE SCHOOL POSITION
            // ==============================================================================================================================================================================

            // ==============================================================================================================================================================================
            // START CREATE SCHOOL USER
            // ==============================================================================================================================================================================
            $school_user = SchoolUser::create([
                'school_id'                 => $school->id,
                'student_number'            => "0325241-$school->id",
                'student_name'              => $data['step2_pic_name'],
                'school_group_id'           => SchoolGroup::where('school_id', $school->id)->where('group_code', 'KR')->first()->id,
                'school_position_id'        => SchoolPosition::where('school_id', $school->id)->where('position_code', 'Guru')->first()->id,
                'gender'                    => 'Laki Laki',
                'email'                     => $data['step2_pic_email'],
                'phone_number'              => $data['step2_pic_phone_number'],
                'birth_date'                => Carbon::now(),
                'selfie_img'                => NULL,
                'is_all_location_presence'  => 1,
                'school_location_id'        => $location->id,
                'password'                  => Hash::make($data['step2_pic_password']),
            ]);
            // ==============================================================================================================================================================================
            // START CREATE SCHOOL USER
            // ==============================================================================================================================================================================

            // ==============================================================================================================================================================================
            // START CREATE USER
            // ==============================================================================================================================================================================
            $user = User::create([
                'name'              => $data['step2_pic_name'],
                'email'             => $data['step2_pic_email'],
                'school_id'         => $school->id,
                'role_id'           => 2, // School manager
                'ref_code'          => "0325242-$school->id",
                'backoffice_login'  => 1,
                'password'          => Hash::make($data['step2_pic_password']),
            ]);
            // ==============================================================================================================================================================================
            // END CREATE USER
            // ==============================================================================================================================================================================

            DB::commit();

            return $user;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

    }
}
