<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\PaymentMethodInterface;

class PaymentMethodController extends Controller
{
    private PaymentMethodInterface $payment_method;

    public function __construct(PaymentMethodInterface $payment_method) 
    {
        $this->middleware(['auth','verified']);
        $this->payment_method = $payment_method;
    }

    public function index()
    {
        $all_payment_method = $this->payment_method->getAllPaymentMethods();
        return view('payments.index', ['all_methods' => $all_payment_method]);
    }

    public function store(Request $request) 
    {
        $validated = $request->validate(['name' => 'required|unique:payment_methods|min:4|max:20']);
        $details = $request->only(['name']);
        $details['user_id'] = auth()->id();
        $this->payment_method->createPaymentMethod($details);
        $request->session()->flash('message', 'Payment method added');
        return redirect()->route('index.payment.methods');
    }

    public function show(Request $request)
    {
        $id = $request->route('id');
        $payment_method = $this->payment_method->getPaymentMethodById($id);
        return view('payments.edit', ['payment_method' => $payment_method]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:4|max:20',
            'status' => 'required',
        ]);
        $id = $request->route('id');
        $details = $request->only([
            'name',
            'status',
        ]);
        $details['user_id'] = auth()->id();
        $this->payment_method->updatePaymentMethod($id, $details);
        $request->session()->flash('message', 'Payment method updated');
        return redirect()->route('index.payment.methods');
    }

    public function destroy(Request $request) 
    {
        $id = $request->route('id');
        $this->payment_method->deletePaymentMethod($id);
        $request->session()->flash('message', 'Payment method deleted');
        return redirect()->back();
    }
}
