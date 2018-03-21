<?php

namespace App\Http\Controllers\Morss;

use Auth;
use App\TableMonth as Month;
use App\Models\Morss\MorssSemester as Semester;
use App\Models\Morss\MorssQuestion as Question;
use App\Models\Morss\MorssSurvey as Survey;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TakeSurveyController extends Controller
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
        $months      = Month::all();
        // $semesters   = Semester::orderBy('id', 'DESC')->get();//->paginate(10);
        // $survey   = Survey::userHasSurveyed( Auth::user()->id )->orderBy('id', 'DESC')->get();
        $semesters   = Semester::userHasSurveyed( Auth::user()->id )->get();
        return view('morss.take-survey', compact('months', 'semesters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $semester  = Semester::all();
        $questions = Question::all();
        return view('morss.take-survey', compact('semester', 'questions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        foreach ($request->question_id as $id) {

            $survey = new Survey();

            $survey->semester_id  = $request['semester_id'];
            $survey->user_id      = $request['user_id'];
            $survey->question_id  = $id;
            $survey->rate         = $request['qn_'.$id];
            $survey->save();
        }

        return redirect('/morss');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $semester  = Semester::find($id);
        $surveys   = Survey::userHasSurveyed( Auth::user()->id )->where('semester_id', $id)->get();
        $questions = Question::all();
        return view('morss.take-survey-id', compact('semester', 'surveys', 'questions'));
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
    public function destroy($id)
    {
        //
    }
}
