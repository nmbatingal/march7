<?php

namespace App\Models\Morss;

use App\Offices;
use Illuminate\Database\Eloquent\Model;
use App\Models\Morss\MorssQuestion;

class MorssSurvey extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'morss_surveys';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'semester_id',
        'user_id',
        'question_id',
        'rate',
    ];

    public function semester()
    {
        return $this->belongsTo('App\Models\Morss\MorssSemester', 'semester_id', 'id');
    }

    public function question()
    {
        return $this->belongsTo('App\Models\Morss\MorssQuestion', 'question_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
    
    public function scopeUserHasSurveyed($query, $user = 0)
    {
        return $query->where('user_id', $user);
    }

    public function scopeStaffUsers($query)
    {
        return $query->with('user');
    }

    public static function totalUserSurveyed($semester = [], $user = true)
    {
        $query = MorssSurvey::selectRaw('
                                COUNT(DISTINCT user_id) AS \'total\'
                            ')->join('users', 'morss_surveys.user_id', 'users.id')
                              ->where('semester_id', $semester ? $semester->id : 0)
                              ->where('users._isActive', $user)
                              ->first();
        
        return $query;
    }

    public static function overallIndex($semester = [], $division = null, $user = null)
    {
        $overallIndex   = 0;
        $query = '';

        if ( !empty($semester) )
        {
            if ( isset($user) )
            {
                $query = MorssSurvey::selectRaw('
                                    COUNT(DISTINCT user_id) AS \'response\',
                                    COUNT(DISTINCT question_id) AS \'question\',
                                    COUNT(case rate when 2 then 1 else null end) AS \'no\',
                                    COUNT(case rate when 2 then 1 else null end) AS \'no\',
                                    COUNT(case rate when 3 then 1 else null end) AS \'ns\',
                                    COUNT(case rate when 4 then 1 else null end) AS \'y\',
                                    COUNT(case rate when 5 then 1 else null end) AS \'dy\''
                            )->join('users', 'morss_surveys.user_id', '=', 'users.id')
                              ->where('morss_surveys.semester_id', $semester->id )
                              ->where('users._isActive', 1)
                              ->where('users.id', $user->id)
                              ->first();

            } elseif ( isset($division) ) {

                $query = MorssSurvey::selectRaw(
                                'COUNT(DISTINCT user_id) AS \'response\',
                                COUNT(DISTINCT question_id) AS \'question\',
                                COUNT(case rate when 2 then 1 else null end) AS \'no\',
                                COUNT(case rate when 2 then 1 else null end) AS \'no\',
                                COUNT(case rate when 3 then 1 else null end) AS \'ns\',
                                COUNT(case rate when 4 then 1 else null end) AS \'y\',
                                COUNT(case rate when 5 then 1 else null end) AS \'dy\''
                            )->join('users', 'morss_surveys.user_id', '=', 'users.id')
                              ->join('offices', 'users.office_id', '=', 'offices.id')
                              ->where('users._isActive', 1)
                              ->where('morss_surveys.semester_id', '=', $semester->id )
                              ->whereRaw('(users.office_id = ? OR offices.head_office_id = ?)', [ $division->id, $division->id ])
                              ->first();
            } else {

                $query = MorssSurvey::selectRaw(
                                    'COUNT(DISTINCT user_id) AS \'response\',
                                    COUNT(DISTINCT question_id) AS \'question\',
                                    COUNT(case rate when 2 then 1 else null end) AS \'no\',
                                    COUNT(case rate when 2 then 1 else null end) AS \'no\',
                                    COUNT(case rate when 3 then 1 else null end) AS \'ns\',
                                    COUNT(case rate when 4 then 1 else null end) AS \'y\',
                                    COUNT(case rate when 5 then 1 else null end) AS \'dy\''
                            )->join('users', 'morss_surveys.user_id', '=', 'users.id')
                              ->where('morss_surveys.semester_id', $semester->id )
                              ->where('users._isActive', 1)
                              ->first();
            }

            if ( $query && ( $query->response > 0 ) ) 
            {
                // formula
                // (( Nt + 2NSt + 3Yt + 4DYt ) / (( Qt x Rt ) * 4)) * 100
                
                $overallIndex = ( ( $query->no + ( $query->ns * 2 ) + ( $query->y * 3 ) + ( $query->dy * 4 ) ) / ( ( $query->question * $query->response ) * 4 ) ) * 100;
            }

            $query = $query->response;
        }

        $data = number_format($overallIndex, 2, '.', '');
        
        // return $data;
        return [ 'data' => $data, 'response' => $query ];
    }

    public static function questionMoraleIndex($semester = [], $division = null, $user = null) 
    {
        $overallIndex   = 0;
        $data           = [];
        $questions = MorssQuestion::all();

        if ( !empty($semester) )
        {
            foreach ($questions as $i => $question) {

                if ( isset($division) ) {
                    $query = MorssSurvey::selectRaw(
                                'morss_questions.question AS \'question\',
                                COUNT(DISTINCT user_id) AS \'response\',
                                COUNT(case rate when 2 then 1 else null end) AS \'no\',
                                COUNT(case rate when 2 then 1 else null end) AS \'no\',
                                COUNT(case rate when 3 then 1 else null end) AS \'ns\',
                                COUNT(case rate when 4 then 1 else null end) AS \'y\',
                                COUNT(case rate when 5 then 1 else null end) AS \'dy\''
                        )->join('morss_questions', 'morss_surveys.question_id', '=', 'morss_questions.id')
                          ->join('users', 'morss_surveys.user_id', '=', 'users.id')
                          ->join('offices', 'users.office_id', '=', 'offices.id')
                          ->where('morss_surveys.question_id', $question->id )
                          ->where('morss_surveys.semester_id', $semester->id )
                          ->where('users._isActive', 1)
                          ->where('users.office_id', '=', $division->id)
                          ->orWhere('offices.head_office_id', '=', $division->id)
                          ->groupBy('question')
                          ->first();
                } elseif ( isset($user) ) {
                    $query = MorssSurvey::selectRaw(
                                        'morss_questions.question AS \'question\',
                                        COUNT(DISTINCT user_id) AS \'response\',
                                        COUNT(case rate when 2 then 1 else null end) AS \'no\',
                                        COUNT(case rate when 2 then 1 else null end) AS \'no\',
                                        COUNT(case rate when 3 then 1 else null end) AS \'ns\',
                                        COUNT(case rate when 4 then 1 else null end) AS \'y\',
                                        COUNT(case rate when 5 then 1 else null end) AS \'dy\''
                                )->join('morss_questions', 'morss_surveys.question_id', '=', 'morss_questions.id')
                                  ->join('users', 'morss_surveys.user_id', '=', 'users.id')
                                  ->where('morss_surveys.question_id', $question->id )
                                  ->where('morss_surveys.semester_id', $semester->id )
                                  ->where('users._isActive', 1)
                                  ->groupBy('question')
                                  ->first();
                } else {
                    $query = MorssSurvey::selectRaw(
                                        'morss_questions.question AS \'question\',
                                        COUNT(DISTINCT user_id) AS \'response\',
                                        COUNT(case rate when 2 then 1 else null end) AS \'no\',
                                        COUNT(case rate when 2 then 1 else null end) AS \'no\',
                                        COUNT(case rate when 3 then 1 else null end) AS \'ns\',
                                        COUNT(case rate when 4 then 1 else null end) AS \'y\',
                                        COUNT(case rate when 5 then 1 else null end) AS \'dy\''
                                )->join('morss_questions', 'morss_surveys.question_id', '=', 'morss_questions.id')
                                  ->join('users', 'morss_surveys.user_id', '=', 'users.id')
                                  ->where('morss_surveys.question_id', $question->id )
                                  ->where('morss_surveys.semester_id', $semester->id )
                                  ->where('users._isActive', 1)
                                  ->groupBy('question')
                                  ->first();
                }

                if ( $query && ( $query->response > 0 ) ) 
                {
                    $overallIndex = ( ( $query->no + ( $query->ns * 2 ) + ( $query->y * 3 ) + ( $query->dy * 4 ) ) / (  $query->response  * 4 ) ) * 100;
                    $data[] = [ 'question' => $query->question, 'value'    => number_format($overallIndex, 2, '.', '') ];
                }
            }

            if ( $query && ( $query->response > 0 ) ) 
            {
                $overallIndex = ( ( $query->no + ( $query->ns * 2 ) + ( $query->y * 3 ) + ( $query->dy * 4 ) ) / (  $query->response  * 4 ) ) * 100;
                $data[] = [ 'question' => $query->question, 'value'    => number_format($overallIndex, 2, '.', '') ];
            }
        }

        return $data;
        // return [ $data, $query->toArray() ];
    }
}