<?php
namespace App\Interfaces;

use Illuminate\Http\JsonResponse;

interface SmsInterface {

    public function sendSMS(int $to, string $message);
}