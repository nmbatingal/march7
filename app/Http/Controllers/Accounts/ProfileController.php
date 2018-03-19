<?php

namespace App\Http\Controllers\Accounts;

use Auth;
use Session;
use App\User;
use App\Offices;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'isAdmin'])->except(['show', 'update', 'updatePassword']);
    }

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
        $roles   = Role::get();
        $offices = Offices::orderBy('office_name', 'ASC')->get();
        return view('accounts.profile', compact('profile', 'offices', 'roles'));
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
     * Update user account roles
     *
     *
     */
    public function updateUserRoles(Request $request, User $profile)
    {
        $roles = $request['roles'];
        $profile->save();

        if (isset($roles)) {        
            $profile->roles()->sync($roles);  //If one or more role is selected associate user to roles          
        }        
        else {
            $profile->roles()->detach(); //If no role is selected remove exisiting role associated to a user
        }

        $toastr = Session::flash('toastr', [ 
            [
                'heading' => 'Success',
                'text'    => 'Roles successfully updated!', 
                'icon'    => 'info', 
            ],
        ]);

        return redirect('accounts/profile/'.$profile->id);
    }

    /**
     * Update the username and password of the user
     *
     *
     */
    public function resetPassword(Request $request, User $profile)
    {
        $profile->password     = bcrypt('dostcaraga');

        if ( $profile->save() )
        {
            $toastr = Session::flash('toastr', [ 
                [
                    'heading' => 'Success',
                    'text'    => 'Reset password successful!', 
                    'icon'    => 'success', 
                ],
            ]);
        }

        return redirect('/accounts');
    }

    /**
     * Update the username and password of the user
     *
     *
     */
    public function updatePassword(Request $request, User $profile)
    {
        $profile->username     = $request->username;
        $profile->password     = bcrypt($request->password);

        if ( $profile->save() )
        {
            $toastr = Session::flash('toastr', [ 
                [
                    'heading' => 'Success',
                    'text'    => 'Login account successfully updated!', 
                    'icon'    => 'info', 
                ],
            ]);
        }

        return redirect('accounts/profile/'.$profile->id);
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
