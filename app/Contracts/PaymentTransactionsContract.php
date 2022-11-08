<?php

namespace App\Contracts;

interface PaymentTransactionsContract
{
    public function allTransactions();
    public function storeTransactions(array $details);
    public function stripepg(array $details);
    public function updateTransactions();
}