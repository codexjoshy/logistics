<?php

namespace App\Interfaces;

use App\Models\Payment;

interface PaymentInterface
{

    /**
     * Prepare the transaction and return an instance of payment class
     *
     * @param float $amount
     * @param string $item
     * @param array $info
     * @return \App\Models\Payment
     */
    public function prepare(float $amount, string $description, array $info = []): Payment;
    /**
     * Prepare the transaction and return an instance of payment class
     *
     * @param float $amount
     * @param string $item
     * @param array $info
     * @return \App\Models\Payment
     */
    public function prepareAdmin(float $amount, array $info = [], int $user): Payment;

    /**
     * Verify the given payment record
     *
     * @param string $reference
     * @return array ['status' => false, 'error' => $response]
     */
    public function verify(string $reference): array;
}