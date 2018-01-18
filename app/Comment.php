<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['comment', 'user_id'];
    
    public function Post() {
        return $this->belongsTo(Post::class);
    }
    
    public function User() {
        return $this->belongsTo(User::class);
    }
    
    protected $dates = ['deleted_at'];
    
}
