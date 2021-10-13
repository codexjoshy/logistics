<?php

namespace App\Services;

use App\Models\Transaction;
use App\Notifications\WalletCreditedNotification;
use Carbon\Carbon;

class TransactionService {
    public function userTransactions(int $user)
    {
        return Transaction::where('user', $user)->latest()->get();
    }
    public function getBalance(int $user)
    {
        return Transaction::select('balance')->where('user_id', $user)->latest()->value('balance') ?? 0.00;
    }
    public function debit(int $user, float $amount, string $description, ?int $poster = null)
    {
        $currentBalance = floatval($this->getBalance($user));
        $data = [
            "user_id"=> $user, "description"=> $description, "type"=>'debit', "poster"=>$poster,
            "balance"=> $currentBalance - $amount, "amount"=>$amount
        ];
        return Transaction::create($data);
    }
    public function credit(int $user, float $amount, string $description, ?int $poster = null)
    {
        $currentBalance = floatval($this->getBalance($user));
        $data = [
            "user_id"=> $user, "description"=> $description, "type"=>'credit', "poster"=>$poster,
            "balance"=> $currentBalance + $amount, "amount"=>$amount
        ];
        return Transaction::create($data);
    }
}

?>