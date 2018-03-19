<?php

namespace App\Models\Morss;

use Illuminate\Database\Eloquent\Model;

class MorssSemester extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'morss_semesters';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'month_from',
        'month_to',
        'year',
    ];

    public function monthFrom()
    {
        return $this->belongsTo('App\TableMonth', 'month_from', 'id');
    }

    public function monthTo()
    {
        return $this->belongsTo('App\TableMonth', 'month_to', 'id');
    }
}
