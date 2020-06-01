<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $fillable = ['name','surname','second_name'];
    public function books(){
        return $this->belongsToMany('App\Book','author_book');
    }
}
