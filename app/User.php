<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Laracasts\Presenter\PresentableTrait;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;
    use PresentableTrait;
    use EntrustUserTrait; 
    public $presenter = 'App\good\Presenters\UserPresenter';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password','title','info','avatar'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function articles()
    {
        return $this->hasMany('App\Article');
    }

    public function upvotes()
    {
        return $this->beLongsToMany('App\Article','votes')->withTimestamps();
    }

    //search user->notification 
    public function notifications()
    {
        //一个user有很多通知
        return $this->hasMany('App\Notification')->recent()->with('article', 'fromUser')->paginate(20);
    }
}
