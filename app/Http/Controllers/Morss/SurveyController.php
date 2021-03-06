<?php

namespace App\Http\Controllers\Morss;

use Session;
use App\TableMonth as Month;
use App\Models\Morss\MorssSemester as Semester;
use App\Models\Morss\MorssQuestion as Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SurveyController extends Controller
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
        $months = Month::all();
        $semesters = Semester::orderBy('id', 'DESC')->paginate(10);
        return view('morss.survey', compact('months', 'semesters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $months    = Month::all();
        $questions = Question::all();
        return view('morss.question', compact('months', 'questions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $question = new Question();
        $question->question = nl2br($request['question']);

        if ( $question->save() )
        {
            $toastr = Session::flash('toastr', [ 
                [
                    'heading' => 'Success',
                    'text'    => 'New question added successfully!', 
                    'icon'    => 'success', 
                ],
            ]);
        }

        return redirect('/morss/survey/create');
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
    public function destroy(Question $survey)
    {
        if ( $survey->delete() )
        {
            $toastr = Session::flash('toastr', [ 
                [
                    'heading' => 'Success',
                    'text'    => 'Question successfully removed!', 
                    'icon'    => 'success', 
                ],
            ]);
        }

        return redirect('/morss/survey/create');
    }
}
