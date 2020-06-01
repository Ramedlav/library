<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['name','description','public_date'];
    public function authors(){
        return $this->belongsToMany('App\Author');
    }
}
