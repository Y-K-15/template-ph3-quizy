<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BigQuestion extends Model
{
    //
    public function showBigQuestion(){
        return $this->id ." . " .$this->name;
    }


    public function questions(){
        return $this->hasMany(Question::class);
    }

    // public function questions(){
    //     return $this->hasMany('App\Question');
    // }

}
