<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QtsEnquete extends Model
{
    use HasFactory;
    public $table = ('question_enquete');

    protected $fillable =[
        'question_id',
        'enquete_id'
    ];

}
