<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class PaymentRepository extends Repository
{
   const MODEL = Paymant::class;

//    public function getActiveUsers() {
//         return User::query()->where('role', 'admin')->get();
//    }

//    public function getUsers(): Collection
//    {
//        return User::all();
//    }
}
