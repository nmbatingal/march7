<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    use HasRoles;

    // protected $connection = 'mysql_trace';
    
    // protected $table = 't_users';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 
        'password',
        'lastname',
        'firstname',
        'middlename',
        'sex',
        'birthday',
        'address',
        'email', 
        'mobile_number', 
        'office_id', 
        'position', 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getFullNameLastAttribute()
    {
        $middlename = !empty($this->attributes['middlename']) ? $this->attributes['middlename'][0].'. ' : '';

        return $this->attributes['lastname'] . ', ' . $this->attributes['firstname'] . ' ' . $middlename;
    }

    public function getFullNameFirstAttribute()
    {
        $middlename = !empty($this->attributes['middlename']) ? $this->attributes['middlename'][0].'. ' : '';

        return $this->attributes['firstname'] . ' ' . $middlename . $this->attributes['lastname'];
    }

    public function office()
    {
        return $this->belongsTo('App\Offices', 'office_id', 'id');
    }

    public function userLogs()
    {
        return $this->hasMany('App\UserLogs', 'user_id', 'id');
    }

    public function surveys()
    {
        return $this->hasMany('App\Models\Morss\MorssSurvey', 'user_id', 'id');
    }

    public function scopeStaffUsers($query)
    {
        return $query->where('_isActive', 1)->role('Staff');
    }
}
