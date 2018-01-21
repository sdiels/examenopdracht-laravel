<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Point extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['point', 'post_id', 'user_id'];
    
    public function Post() {
        return $this->belongsTo(Post::class);
    }
    
    public function User() {
        return $this->belongsTo(User::class);
    }
    
    protected $dates = ['deleted_at'];
}
