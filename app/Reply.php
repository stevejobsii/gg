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

    public function votes()
    {
        return $this->morphMany('Vote', 'votable');
    }

    public function user()
    {
        return $this->belongsTo('User');
    }

    public function topic()
    {
        return $this->belongsTo('Topic');
    }

    public function scopeWhose($query, $user_id)
    {
        return $query->where('user_id', '=', $user_id)->with('topic');
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
}
