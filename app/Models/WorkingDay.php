<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkingDay extends Model
{
    use HasFactory;

    protected $table = 'working_days';

    public function worker(){
        return $this->belongsTo(User::class);
    }



}
