<?php namespace App;
use Illuminate\Database\Eloquent\Model as Eloquent;

class Note extends Eloquent {
    
    protected $table = 'simple-notes';
    
    protected $fillable = [
        'title', 'content', 'user_id'    
    ];
    
}