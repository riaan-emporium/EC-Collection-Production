<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Laravel\Cashier\Billable;
use Laravel\Cashier\Contracts\Billable as BillableContract;


class User extends Model implements AuthenticatableContract, CanResetPasswordContract,BillableContract
{
    use Authenticatable, CanResetPassword;

    use Billable;

    protected $dates = ['trial_ends_at', 'subscription_ends_at'];
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tb_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'group_id',
        'first_name',
        'last_name',
        'mobile_code',
        'mobile_number',
        'email',
        'password',
        'country',
        'prefer_communication_with',
        'questions_id',
        'answer',
        'gender',
        'avatar'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];
}
