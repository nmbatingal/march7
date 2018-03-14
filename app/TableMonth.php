<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TableMonth extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'table_month';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'month_name', 
        'acronym',
    ];
}
