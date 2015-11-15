<?php namespace App;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{

    protected $fillable = [
        'body',
        'user_id',
        'article_id',
        // 'body_original',
    ];

    public static function boot()
    {
        parent::boot();

 
    }
    
    // public function replyvote()
    // {
    //     return Vote::where('votable', '=', 'App\Reply')->where('votable_id', '=', $this->id)->get();
    // }
    public function votes()
    {
        return $this->morphMany('App\Vote', 'votable');
    }

    public function user()
    {
        return $this->belongsTo('App\User','user_id');//加了'user_id',818
    }

    public function article()
    {
        return $this->belongsTo('App\Article','article_id');
    }

    public function scopeWhose($query, $user_id)
    {
        return $query->where('user_id', '=', $user_id);
    }


    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
}
