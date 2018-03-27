<?php

namespace App\Models\Morss;

use Illuminate\Database\Eloquent\Model;

class MorssQuestion extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'morss_questions';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'question',
    ];

    public function surveys()
    {
        return $this->belongsTo('App\Models\Morss\MorssSurvey', 'question_id', 'id');
    }
}
