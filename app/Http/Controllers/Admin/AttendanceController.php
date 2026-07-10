<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class AttendanceController extends Controller
{
    public function users(Request $request)
    {
        $date = $request->date ?? now()->toDateString();

        $users = User::with(['attendances' => function ($q) use ($date) {
        $q->whereDate('date', $date);
        }])
        ->when($request->search, function ($q) use ($request) {
            $q->where(function ($qq) use ($request) {
                $qq->where('first_name', 'like', '%' . $request->search . '%')
                    ->orWhere('last_name', 'like', '%' . $request->search . '%')
                    ->orWhere('employee_code', 'like', '%' . $request->search . '%');
            });
        })
        ->orderBy('user_type_id')  
        ->orderBy('first_name')
        ->get()
        ->groupBy('user_type_id');


        return view('admin.attendance.users', compact('users', 'date'));
    }

    public function attendancePage($id)
    {
        $user = User::findOrFail($id);

        $attendance = Attendance::where('user_id', $id)
            ->where('date', date('Y-m-d'))
            ->first();

        return view('admin.attendance.mark', compact('user', 'attendance'));
    }

    private function distance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371000;

        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat / 2) * sin($dLat / 2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($dLon / 2) * sin($dLon / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        return $earthRadius * $c;
    }
    public function checkIn(Request $request)
    {
        if (!$request->photo) {
            return response()->json([
                'status' => 'error',
                'message' => 'Please capture photo first'
            ]);
        }

        $officeLat = env('OFFICE_LAT');
        $officeLng = env('OFFICE_LNG');

        $distance = $this->distance(
            $request->latitude,
            $request->longitude,
            $officeLat,
            $officeLng
        );

        if ($distance > env('ALLOWED_RADIUS')) {
            return response()->json([
                'status' => 'error',
                'message' => 'Outside office area'
            ]);
        }

        $user = User::findOrFail($request->user_id);

        $officeTime = Carbon::parse($user->in_time, 'Asia/Kolkata');
        $now = Carbon::now('Asia/Kolkata');

        if ($now->gt($officeTime)) {
            return response()->json([
                'status' => 'error',
                'message' => 'You are late. Check-In closed.'
            ]);
        }

        $image = str_replace('data:image/png;base64,', '', $request->photo);
        $image = str_replace(' ', '+', $image);

        $name = 'attendance_' . time() . '.png';
        Storage::disk('public')->put('attendance/' . $name, base64_decode($image));

        Attendance::create([
            'user_id' => $request->user_id,
            'date' => date('Y-m-d'),
            'check_in' => $now->format('H:i:s'),
            'status' => 'on_time',
            'checkin_photo' => 'attendance/' . $name,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'address' => $request->address
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Checked In Successfully'
        ]);
    }


    public function checkOut(Request $request)
    {
        if (!$request->photo) {
            return response()->json([
                'status' => 'error',
                'message' => 'Please capture checkout photo'
            ]);
        }

        if (!$request->checkout_address) {
            return response()->json([
                'status' => 'error',
                'message' => 'Checkout address missing'
            ]);
        }

        $officeLat = env('OFFICE_LAT');
        $officeLng = env('OFFICE_LNG');

        $distance = $this->distance(
            $request->latitude,
            $request->longitude,
            $officeLat,
            $officeLng
        );

        if ($distance > env('ALLOWED_RADIUS')) {
            return response()->json([
                'status' => 'error',
                'message' => 'Checkout allowed only inside office'
            ]);
        }

        $att = Attendance::where('user_id', $request->user_id)
            ->whereDate('date', now())
            ->first();

        if (!$att) {
            return response()->json([
                'status' => 'error',
                'message' => 'No check-in found'
            ]);
        }

        // Save image
        $image = str_replace('data:image/png;base64,', '', $request->photo);
        $image = str_replace(' ', '+', $image);

        $name = 'attendance_' . time() . '.png';

        Storage::disk('public')->put('attendance/' . $name, base64_decode($image));

        $out = Carbon::now();
        $in  = Carbon::parse($att->check_in);

        $att->check_out = $out->format('H:i:s');
        $att->working_minutes = $out->diffInMinutes($in);
        $att->checkout_photo = 'attendance/' . $name;
        $att->checkout_address = $request->checkout_address;

        $att->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Checked Out Successfully'
        ]);
    }



    public function attendanceList()
    {
        $records = Attendance::with('user')->latest()->get();
        return view('admin.attendance.list', compact('records'));
    }
    public function reverseGeocode(Request $request)
    {
        try {

            $lat = $request->lat;
            $lng = $request->lng;

            $response = Http::withHeaders([
                'User-Agent' => 'LaravelAttendanceApp'
            ])->withoutVerifying()
                ->timeout(10)
                ->get('https://nominatim.openstreetmap.org/reverse', [
                    'format' => 'json',
                    'lat' => $lat,
                    'lon' => $lng
                ]);

            return response()->json($response->json());
        } catch (\Exception $e) {

            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function attendanceReport(Request $request)
    {
        $date = $request->date ?? now()->toDateString();

        $attendances = Attendance::with('user')
            ->whereDate('date', $date)
            ->orderBy('check_in')
            ->get();

        return view('admin.attendance.report', compact('attendances', 'date'));
    }
    public function calendar(Request $request)
    {
        $month = $request->Month ?? now()->format('m');
        $year  = $request->Year ?? now()->format('Y');

        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

        $users = User::with(['attendances' => function ($q) use ($month, $year) {
            $q->whereMonth('date', $month)
                ->whereYear('date', $year);
        }])->get();

        return view('admin.attendance.calendar', compact(
            'users',
            'month',
            'year',
            'daysInMonth'
        ));
    }
}
