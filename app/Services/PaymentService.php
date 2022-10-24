<?php

namespace App\Services;


use App\Repositories\PaymantRepository;
use App\Models\WorkingDay;
use App\Models\OffDay;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PaymentService
{
    private PaymentRepository $paymentRepository;
    public function __construct(PaymentRepository $paymentRepository) {
        $this->paymentRepository = $paymentRepository;
    }









}
