<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offices extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'offices';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'office_name', 
        'acronym',
    ];

    public function staffs()
    {
        return $this->hasMany('App\User', 'office_id', 'id');
    }

    /*public function scopeStaffCount($query)
    {
        return $query->where
    }*/
}
