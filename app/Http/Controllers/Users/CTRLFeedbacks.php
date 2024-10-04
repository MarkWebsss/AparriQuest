<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Users\Feedbacks;

use Gate;
use DB;
use Auth;

class CTRLFeedbacks extends Controller
{

    public function __contruct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        // denies the gate if 
        if(Gate::denies('user-access')){
            return redirect('errors.403');
        }
        
        return view('users.feedback.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
        ]);

        $user = Feedbacks::create([
            'email' => $request->email,
            'rate' => $request->rate,
            'comments' => $request->comm
        ]);

        return redirect()->back()->withInput()->with('status','Feedback Submitted Successfully!');


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

     /**
     * Remove the specified resource from storage.
     */
    public function myfeedback()
    {
        //
        $myfeedbacks = DB::table('feedbacks')
        ->select('*')
        ->where('email',Auth::user()->email)
        ->paginate(1);
        
        return view('users.feedback.myfeedbacks')
        ->with('myfeedbacks',$myfeedbacks);

    }
}
