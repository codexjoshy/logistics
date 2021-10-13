<?php
namespace App\Interfaces;

use Illuminate\Http\JsonResponse;
use Zeevx\LaraTermii\LaraTermii;

interface SmsInterface {

    public function sendSMS(string $from, int $to, string $message);
}