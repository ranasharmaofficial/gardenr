<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MemberMessage;
use App\Models\User;
use App\Repositories\Interfaces\StaffRepositoryInterface;
use Illuminate\Http\Request;

class SmsController extends Controller
{
    public function smsList()
    {
        $page_title = 'SMS List';

        $messages = MemberMessage::with('user')
            ->orderBy('id', 'desc')
            ->paginate(20);

        return view('admin.sms.index', compact('messages', 'page_title'));
    }
}
