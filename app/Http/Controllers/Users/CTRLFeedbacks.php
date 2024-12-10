<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Users\Feedbacks;
use Gate;

class CTRLFeedbacks extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        if (Gate::denies('user-access')) {
            return redirect('errors.403');
        }

        $myfeedbacks = DB::table('feedbacks')
            ->select('*')
            ->where('email', Auth::user()->email)
            ->paginate(5);

        return view('users.feedback.create')->with('myfeedbacks', $myfeedbacks);
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
        ]);

        Feedbacks::create([
            'email' => $request->email,
            'rate' => $request->rate,
            'comments' => $request->comm,
        ]);

        return redirect()->back()->withInput()->with('status', 'Feedback Submitted Successfully!');
    }

    public function myfeedback()
    {
        $myfeedbacks = DB::table('feedbacks')
            ->select('*')
            ->where('email', Auth::user()->email)
            ->paginate(5);

        return view('users.feedback.myfeedbacks')->with('myfeedbacks', $myfeedbacks);
    }
}
