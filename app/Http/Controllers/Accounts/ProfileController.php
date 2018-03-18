<?php

namespace App\Http\Controllers\Accounts;

use Session;
use App\User;
use App\Offices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $profile)
    {
        $offices = Offices::orderBy('office_name', 'ASC')->get();
        return view('accounts.profile', compact('profile', 'offices'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $profile)
    {
        $profile->firstname  = $request->firstname;
        $profile->middlename = $request->middlename;
        $profile->lastname   = $request->lastname;
        $profile->sex        = $request->sex;
        $profile->birthday   = $request->birthday;
        $profile->address    = $request->address;
        $profile->email      = $request->email;
        $profile->mobile_number  = $request->mobile_number;
        $profile->position   = $request->position;
        $profile->office_id     = $request->office;

        if ( $profile->save() )
        {
            $toastr = Session::flash('toastr', [ 
                [
                    'heading' => 'Success',
                    'text'    => 'Account successfully updated!', 
                    'icon'    => 'info', 
                ],
            ]);
        }

        return redirect('accounts/profile/'.$profile->id);
        // return dd($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
