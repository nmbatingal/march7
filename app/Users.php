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

    protected $connection = 'mysql2';
    protected $table = 't_users';
    protected $primaryKey = 'u_id';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    // protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    /*protected $fillable = [
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
    ];*/

    protected $fillable = [
        'u_username', 
        'u_email',
        'u_fname',
        'u_mname',
        'u_lname',
        'u_mobile',
        'ug_id',
        'group_id',
        'u_position',
        'u_picture',
        'u_active',
        'u_administrator',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'u_password', 'remember_token',
    ];

    public function getFullNameLastAttribute()
    {
        $middlename = !empty($this->attributes['u_mname']) ? $this->attributes['u_mname'][0].'. ' : '';

        return $this->attributes['u_lname'] . ', ' . $this->attributes['u_fname'] . ' ' . $middlename;
    }

    public function getFullNameFirstAttribute()
    {
        $middlename = !empty($this->attributes['u_m']) ? $this->attributes['u_m'][0].'. ' : '';

        return $this->attributes['u_fname'] . ' ' . $middlename . $this->attributes['u_lname'];
    }

    public function office()
    {
        return $this->belongsTo('App\Offices', 'office_id', 'id');
    }

    public function userLogs()
    {
        return $this->hasMany('App\UserLogs', 'user_id', 'u_id');
    }

    public function surveys()
    {
        return $this->hasMany('App\Models\Morss\MorssSurvey', 'user_id', 'u_id');
    }

    public function scopeStaffUsers($query)
    {
        // return $query->where('_isActive', 1)->role('Staff');
        return $query->where('u_active', 1)->role('Staff');
    }
}
