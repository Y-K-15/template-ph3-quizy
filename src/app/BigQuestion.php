<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BigQuestion extends Model
{
    //
    protected $fillable = [
        'name'
    ];
    // 新規追加できるように
    // https://qiita.com/miriwo/items/9ae2500bfc3f26e83e3a

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
