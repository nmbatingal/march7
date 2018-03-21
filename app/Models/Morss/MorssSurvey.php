<?php

namespace App\Models\Morss;

use Illuminate\Database\Eloquent\Model;

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
        // return $query->where('semester_id', $semester)->where('user_id', $user)->count();
        return $query->where('user_id', $user);
    }
}
