<?php

namespace App\Models\Morss;

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

    public function scopeStaff($query)
    {
        return $query->with('user');
    }

    public static function overallIndex($semester = [], $user = [])
    {
        $overallIndex   = 0;
        if ( !$user )
        {
            $query = MorssSurvey::select(
                            \DB::raw(
                                'COUNT(DISTINCT user_id) AS \'response\',
                                COUNT(DISTINCT question_id) AS \'question\',
                                COUNT(case rate when 2 then 1 else null end) AS \'no\',
                                COUNT(case rate when 2 then 1 else null end) AS \'no\',
                                COUNT(case rate when 3 then 1 else null end) AS \'ns\',
                                COUNT(case rate when 4 then 1 else null end) AS \'y\',
                                COUNT(case rate when 5 then 1 else null end) AS \'dy\''
                        ))->join('users', 'morss_surveys.user_id', '=', 'users.id')
                          ->where('morss_surveys.semester_id', $semester->id )
                          ->where('users._isActive', 1)
                          ->first();
        } else {
            $query = MorssSurvey::select(
                            \DB::raw(
                                'COUNT(DISTINCT user_id) AS \'response\',
                                COUNT(DISTINCT question_id) AS \'question\',
                                COUNT(case rate when 2 then 1 else null end) AS \'no\',
                                COUNT(case rate when 2 then 1 else null end) AS \'no\',
                                COUNT(case rate when 3 then 1 else null end) AS \'ns\',
                                COUNT(case rate when 4 then 1 else null end) AS \'y\',
                                COUNT(case rate when 5 then 1 else null end) AS \'dy\''
                        ))->join('users', 'morss_surveys.user_id', '=', 'users.id')
                          ->where('morss_surveys.semester_id', $semester->id )
                          ->where('users._isActive', 1)
                          ->where('users.id', $user->id)
                          ->first();
        }

        if ( $query && ( $query->response > 0 ) ) 
        {
            // formula
            // (( Nt + 2NSt + 3Yt + 4DYt ) / (( Qt x Rt ) * 4)) * 100
            $overallIndex = ( ( $query->no + ( $query->ns * 2 ) + ( $query->y * 3 ) + ( $query->dy * 4 ) ) / ( ( $query->question * $query->response ) * 4 ) ) * 100;
        }

        // return [ $overallIndex, $query->toArray() ];
        $data = number_format($overallIndex, 2, '.', '');
        return $data;
    }
}