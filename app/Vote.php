<?php namespace App;
use Illuminate\Database\Eloquent\Model;
/**
 * 1. User can vote a topic;
 * 2. User can vote a reply;
 */
class Vote extends Model{

    protected $fillable = ['user_id', 'votable_id', 'votable_type', 'is'];

    public function votable()
    {
        return $this->morphTo();
    }
   
    public function reply()
    {
        return $this->belongsTo('App\Reply','votable_id');
    }


    public function article()
    {
        return $this->belongsTo('App\Article','votable_id');
    }

    public function scopeByWhom($query, $user_id)
    {
        return $query->where('user_id', '=', $user_id);
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
