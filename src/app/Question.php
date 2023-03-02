<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //
    protected $fillable = [
        'big_question_id',
        'image',
        'sort',
    ];

    public function choices()
    {
        return $this->hasMany(Choice::class);
    }

    public function bigQuestion()
    {
        return $this->belongsTo(BigQuestion::class);
    }

}
