<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserTraining extends Model
{
    protected $table = 'usertraining';
    protected $fillable = ['id', 'user_id', 'training_name', 'training_details'];
}
