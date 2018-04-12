<?php

namespace App\Http\Controllers\Accounts;

use Session;
use App\User;
use App\Offices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AccountsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'isAdmin']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users   = User::withTrashed()->get();
        $offices = Offices::orderBy('office_name', 'ASC')->get();
        return view('accounts.index', compact('users', 'offices'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $account)
    {
        if ( $account->delete() )
        {
            $toastr = Session::flash('toastr', [ 
                [
                    'heading' => 'Success',
                    'text'    => 'Account successfully removed!', 
                    'icon'    => 'success', 
                ],
            ]);
        }

        return redirect('accounts/');
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $user = User::withTrashed()->where('id', $id); 

        if ( $user->restore() )
        {
            $toastr = Session::flash('toastr', [ 
                [
                    'heading' => 'Success',
                    'text'    => 'Account successfully restored!', 
                    'icon'    => 'success', 
                ],
            ]);
        }

        return redirect('accounts/');
    }
}
