<?php

namespace App\Http\Controllers\Morss;

use Auth;
use Session;
use App\User;
use App\Offices;
use App\Models\Morss\MorssSemester as Semester;
use App\Models\Morss\MorssQuestion as Question;
use App\Models\Morss\MorssSurvey as Survey;
use App\Models\Morss\MorssSurveyRemarks as Remarks;
use App\Notifications\MoraleSurveyNotification;
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
        $this->middleware(['auth']);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ( Auth::user()->hasanyrole(['System Administrator', 'Unit Head']) ) {

            // $userSurvey   = Semester::orderBy('created_at', 'DESC')->surveyAvailable(true)->with('surveys')->get();
            $semesters = Semester::orderBy('created_at', 'DESC')->surveyAvailable(true)->with([
                'surveys' => function ($query) {
                    $query->join('users', 'morss_surveys.user_id', '=', 'users.id')
                          ->where('users._isActive', 1);
                }
            ])->get();

            $overallIndex    = Survey::overallIndex( $semesters->first() );
            $division_data[] = [ 'name' => 'Overall Index', 'oi_value' => $overallIndex];
            $divisions       = ['ORD', 'FAS', 'FOD', 'TSS'];
            $remarks         = Remarks::where('semester_id', $semesters->first() ? $semesters->first()->id : 0 )->orderBy('created_at', 'DESC')->get();

            foreach ( $divisions as $division ) {

                $office       = Offices::where('acronym', '=', $division)->first();
                $division_oi  = Survey::overallIndex( $semesters->first(), $office );
                $division_data[] = [ 'name' => $division, 'oi_value' => $division_oi ];

            }

            $questions     = Survey::questionMoraleIndex( $semesters->first() );
            $totalSurveyed = Survey::totalUserSurveyed( $semesters->first() );
            $totalUsers    = User::staffUsers()->count();

            if ( $totalSurveyed->total != 0 && $totalUsers != 0) {
                $percentSurveyed = ( $totalSurveyed->total / $totalUsers ) * 100;
            } else {
                $percentSurveyed = 0;
            }

            return view('morss.index', [
                        // 'userSurvey' => $userSurvey,
                        'semesters'           => $semesters,
                        'division_data'       => $division_data,
                        'questions'           => $questions,
                        'totalSurveyed'       => $totalSurveyed,
                        'totalUsers'          => $totalUsers,
                        'percentSurveyed'     => $percentSurveyed,
                        'remarks'             => $remarks,
                    ]);

        } else {
            return view('morss.staff.index');
        }
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

            /*** FOR NOTIFICATION ***/
            $notify_users = User::where('id', '<>', Auth::user()->id )->staffUsers()->get();
            $action_user  = User::find(Auth::user()->id);

            $data = [
                'data'    => 'has created a '. $semester->semesterRangeFormal .' Morale Survey Form',
                'action'  => '/morss/survey/takesurvey/'.$semester->id,
            ];

            foreach ($notify_users as $user) {
                $user->notify(new MoraleSurveyNotification($action_user, $data));
            }
            /*** END FOR NOTIFICATION ***/

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

        return redirect('/morss/survey');
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
