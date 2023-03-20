<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnqueteQuestion extends Model
{
    use HasFactory;
    protected $table = ('enquete_question');

    public function enquete()
    {
        return $this->hasMany(Enquete::class, 'enquete_id');
    }

    public function question()
    {
        return $this->hasMany(Question::class, 'question_id');
    }
}
