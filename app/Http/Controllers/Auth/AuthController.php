<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use App\Models\UserLogin;
use App\Models\State;
use App\Models\Student;
use App\Models\Course;
use Hash;
use Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cookie;

class AuthController extends Controller
{

    /** Customer Login page start */
    public function login(){
        return view('frontend.auth.login');
    }

    public function postLogin(Request $request){
        $data = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        // $is_loggedin = UserLogin::where([
        //     'username' => $request->email,
        //     'password' => $request->password,
        //     'user_type_id' => 2,
        //     'status' => 1,
        // ])->first();


        $is_loggedin =  UserLogin::join('users', 'users.id', '=', 'user_logins.user_id')
            ->join('user_types', 'user_types.id', '=', 'users.user_type_id')
            ->where('user_logins.username',  $request->email)
            ->where('user_logins.password', $request->password)
            ->where('user_logins.status', 1)
            ->where('user_logins.user_type_id', 2)
            ->select(['users.*', 'user_types.name as userType', 'user_logins.*'])
            ->first();


        if (!$is_loggedin) {
            return redirect()->back()->with(session()->flash('alert-danger', 'Failed! We do not recognize your username or password.'));
        } else  {
            $request->session()->put('LoggedFranchise', $is_loggedin);
            return redirect()->route('franchise.dashboard')->with(session()->flash('alert-success', 'Successfully Loggedin.'));
        }
    }
    /** Customer Login page start */


    /** Customer Registration page start */
    public function registration(){
        $state_list = State::get();
        $course_list = Course::where('status', 1)->get();
        // dd($state_list);
        return view('frontend.auth.register', compact('state_list','course_list'));
    }

    public function getIpAddress(Request $request){
        return $request->ip();
    }

    public function postRegistration(Request $request){
        // dd("I am here");
        // dd($request->all());
       $request->validate([
            'first_name' => 'required',
            'last_name' => 'nullable',
            'institute_name' => 'nullable',
            'state' => 'required',
            'city' => 'required',
            'pincode' => 'required',
            'director_higher_qualifications' => 'required',

            'email' => [
                'required',
                'email',
                Rule::unique('users')->where(function ($query) {
                    return $query->where('status', 1);
                }),
            ],

            'mobile' => [
                'required',
                'min:10',
                'max:13',
                Rule::unique('users')->where(function ($query) {
                    return $query->where('status', 1);
                }),
            ],

            'password' => 'required|min:6',

            'center_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'director_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'aadhar_card' => 'required|mimes:pdf|max:5120',
        ]);

        $data = $request->all();
        $data['ip_address'] = $request->ip();
        if($request->has('center_photo')){
            $data['center_photo'] = upload_asset($request->center_photo, 'franchise_file');
        }else{
            $data['center_photo'] = NULL;
        }

        if($request->has('director_photo')){
            $data['director_photo'] = upload_asset($request->director_photo, 'franchise_file');
        }else{
            $data['director_photo'] = NULL;
        }

        if($request->has('aadhar_card')){
            // $data['aadhar_card'] = upload_asset($request->aadhar_card, 'franchise_file');
            // $pdfPath = $request->file('aadhar_card')->store('uploads/franchise_file', 'public');
            $name = $request->aadhar_card->getClientOriginalName();
            $imageName11 = time().rand(1,999).'.'.$name;
            $request->aadhar_card->move(public_path('uploads/franchise_file'), $imageName11);
            $data['aadhar_card'] = $imageName11;
        }else{
            $data['aadhar_card'] = NULL;
        }

        $check = $this->create($data);
        if($check){
            $user_login = UserLogin::create([
                'username' => $data['email'],
                'password' => $data['password'],
                'user_id' => $check->id,
                'user_type_id' => 2,
                'user_designation_id' => 2,
                'status' => 0,
            ]);
        }

        return redirect()->back()->with(session()->flash('alert-success', 'Successfully Registered.'));
    }

    public function create(array $data){
        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'mobile' => $data['mobile'],
            'email' => $data['email'],
            'institute_name' => $data['institute_name'],
            'state' => $data['state'],
            'city' => $data['city'],
            'pincode' => $data['pincode'],
            'status' => 0,
            'user_type_id' => 2,
            'user_designation_id' => 2,
            'director_higher_qualifications' => $data['director_higher_qualifications'],
            'center_photo' => $data['center_photo'],
            'director_photo' => $data['director_photo'],
            'aadhar_card' => $data['aadhar_card'],
            // 'course_id' => json_encode($data['course_id']),
        ]);
    }
    /** Franchise Registration page End */

    public function logout() {
        Session::flush();
        Auth::logout();
        return Redirect('/')->with(session()->flash('alert-success', 'Successfully Loggedout'));
    }


    public function studentLogin(){
        return view('frontend.auth.customer_login');
    }

    public function poststudentLogin(Request $request){
        $data = $request->validate([
            'enrollment_number' => 'required',
            'dob' => 'required',
        ]);

        $is_loggedin =  Student::where('enrollment_number',  $request->enrollment_number)
            ->where('dob', $request->dob)
            ->where('status', 1)
            ->first();
        // dd($is_loggedin);
        if (!$is_loggedin) {
            return redirect()->back()->with(session()->flash('alert-danger', 'Failed! We do not recognize your username or password.'));
        } else  {
            $request->session()->put('LoggedStudent', $is_loggedin);
            return redirect()->route('student.dashboard')->with(session()->flash('alert-success', 'Successfully Loggedin.'));
        }
    }
    /** Customer Login page start */

    /** Vivah Mitra Login */

    public function vivahMitralogin(){
        if(Session::has('LoggedVivahMitra')){
            return redirect('member/dashboard');
        }else{
            return view('vivah_mitra.auth.login');
        }

    }

    public function vivahMitraLoginPost(Request $request)
    {
         $request->validate([
            'username' => 'required|numeric',
            'password' => 'required',
        ]);
        $token = Str::random(60);
        $user = UserLogin::whereIn('user_type_id', [6,5])->where('username', $request->username)->where('status', 1)->first();
        // dd($user);
        if ($user) {
            // ⚠️ If passwords are plain text in DB (like in your screenshot)
            if ($user->password === $request->password) {
                // ✅ Update last login
                $user->update([
                    'last_login_time' => now(),
                    'status' => 1
                ]);

                $check = User::where('id', $user->user_id)->first();
                $user->remember_token = $token;
                $user->save();

                Cookie::queue('creator_remember', $token, 43200); // 30 days

                $request->session()->put('LoggedVivahMitra', $check);

                return response()->json([
                    'status' => true,
                    'message' => 'Login successful',
                    'redirect_url' => url('member/dashboard'),
                ]);
            }

            // If you use hashed passwords, use this instead:
            /*
            if (Hash::check($request->password, $user->password)) {
                ...
            }
            */
        }
        //  Invalid credentials
        return response()->json([
            'status' => false,
            'message' => 'Invalid username or password',
        ], 401);
    }






}
