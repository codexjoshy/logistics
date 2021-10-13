<?php

namespace App\Services;

use App\Helpers\UniqueNo;
use App\Interfaces\PaymentInterface;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

/**
 * Undocumented class
 */
class PaystackPaymentService implements PaymentInterface
{
    protected UniqueNo $unique;

    public function __construct(UniqueNo $unique)
    {
        $this->unique = $unique;
    }

    public function prepare(float $amount, string $description, array $info = [], ): Payment
    {
        // Write Into Transaction
        return Payment::create([
            'user_id' =>  auth()->id(),
            'reference' => $this->generatePaymentReference(),
            'amount' => $amount,
            'other_info' => $info,
            'status' =>  null
        ]);
    }
    public function prepareAdmin(
        float $amount,
        array $info = [],
        int $user,
        ?string $reference=null,
    ): Payment {
        // Write Into Transaction
        if ($reference) $info['reference'] = $reference;
        return Payment::create([
            'user_id' => $user,
            'reference' => $this->generatePaymentReference(),
            'amount' => $amount,
            'other_info' => $info,
            'status' => $user ? 'success' : null
        ]);
    }

    public function verify($reference): array
    {
        $response = Http::withToken(config('services.payment.paystack.secret'))
            ->get('https://api.paystack.co/transaction/verify/' . $reference)
            ->json();
        if ($response['status'] === 'error') {
            return ['status' => false, 'error' => $response];
        }
        return ['status' => $response, 'error' => null];
    }

    /**
     * Generate the transaction reference string
     *
     * @return string
     */
    protected function generatePaymentReference(): string
    {
        return $this->unique->setValidator(function ($value) {
            return DB::table('unique_no')
                ->where('no', $value)
                ->exists();
        })
            ->setAfterHook(function ($value) {
                DB::table('unique_no')->insert(['no' => $value]);
            })
            ->generate();
    }
}