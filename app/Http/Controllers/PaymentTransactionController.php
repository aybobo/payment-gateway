<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Contracts\PaymentTransactionsContract;
use App\Models\Transaction;
use Illuminate\Http\Request;

class PaymentTransactionController extends Controller implements PaymentTransactionsContract
{
    private PaymentTransactionsContract $payment_gateway;

    public function __construct(PaymentTransactionsContract $payment_gateway)
    {
        $this->payment_gateway = $payment_gateway;
    }

    public function index()
    {
        $user_id = auth()->id();
        $transactions = Transaction::where('user_id', $user_id)->get();
        return view('transactions.index', ['transactions' => $transactions]);

    }

    
}
