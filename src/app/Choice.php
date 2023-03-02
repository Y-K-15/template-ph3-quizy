<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Choice extends Model
{
    //
    protected $fillable = [
        'question_id',
        'name',
        'is_valid',
    ];
    // 新規追加できるように
    // https://qiita.com/miriwo/items/9ae2500bfc3f26e83e3a

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
    
}
