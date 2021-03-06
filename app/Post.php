<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['title', 'url', 'points'];
    
    public function Comments() {
        return $this->hasMany(Comment::class);
    }
    
    public function Points() {
        return $this->hasMany(Point::class);
    }
    
    public function User() {
        return $this->belongsTo(User::class);
    }
    
    protected $dates = ['deleted_at'];
    
}
