<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Upazila extends Model
{
    protected $table = 'upazila';
    protected $fillable = ['id', 'district_id', 'upazila_name'];
}
