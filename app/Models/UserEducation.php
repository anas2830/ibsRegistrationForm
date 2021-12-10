<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserEducation extends Model
{
    protected $table = 'usereducation';
    protected $fillable = ['id', 'user_id', 'exam_name', 'university', 'board', 'result'];
}
