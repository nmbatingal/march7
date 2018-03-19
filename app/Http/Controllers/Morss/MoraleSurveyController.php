<?php

namespace App\Http\Controllers\Morss;

use Session;
use App\Models\Morss\MorssSemester as Semester;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MoraleSurveyController extends Controller
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
        return view('morss.index');
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
        $semester = new Semester();
        $semester->month_from = $request['month_from'];
        $semester->month_to   = $request['month_to'];
        $semester->year       = $request['year'];

        // if ( $semester->save() )
        try
        {
            $semester->save();

            $toastr = Session::flash('toastr', [ 
                [
                    'heading' => 'Success',
                    'text'    => 'New semestral survey successfully created!', 
                    'icon'    => 'success', 
                ],
            ]);
        } catch (\Illuminate\Database\QueryException $e) {
            // return dd($e);
            $toastr = Session::flash('toastr', [ 
                [
                    'heading' => 'Error',
                    'text'    => 'Duplicate entry detected!', 
                    'icon'    => 'error', 
                ],
            ]);
        }

        return redirect('/morss/survey');;
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
    public function destroy(Semester $morss)
    {
        if ( $morss->delete() )
        {
            $toastr = Session::flash('toastr', [ 
                [
                    'heading' => 'Success',
                    'text'    => 'Semester successfully removed!', 
                    'icon'    => 'success', 
                ],
            ]);
        }

        return redirect('/morss/survey');
    }

    public function lockSemester(Semester $morss)
    {
        $morss->status = 0;
        if ( $morss->save() )
        {
            $toastr = Session::flash('toastr', [ 
                [
                    'heading' => 'Success',
                    'text'    => 'Semester successfully locked!', 
                    'icon'    => 'success', 
                ],
            ]);
        }

        return redirect('/morss/survey');
    }

    public function unlockSemester(Semester $morss)
    {
        $morss->status = 1;
        if ( $morss->save() )
        {
            $toastr = Session::flash('toastr', [ 
                [
                    'heading' => 'Success',
                    'text'    => 'Semester successfully unlocked!', 
                    'icon'    => 'success', 
                ],
            ]);
        }

        return redirect('/morss/survey');
    }
}
