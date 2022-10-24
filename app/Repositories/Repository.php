<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

abstract class Repository
{
    public function findById(int $id) {
        return call_user_func(static::MODEL . '::query')->find($id);
    }
}
