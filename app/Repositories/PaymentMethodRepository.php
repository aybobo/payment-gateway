<?php

namespace App\Repositories;

use App\Interfaces\PaymentMethodInterface;
use App\Models\PaymentMethod;

class PaymentMethodRepository implements PaymentMethodInterface 
{
    public function getAllPaymentMethods() 
    {
        $user_id = auth()->id();
        return PaymentMethod::where('user_id', $user_id)->get();
    }

    public function createPaymentMethod(array $details)
    {
        return PaymentMethod::create($details);
    }

    public function getPaymentMethodById($id)
    {
        return PaymentMethod::findOrFail($id);
    }

    public function updatePaymentMethod($id, array $details)
    {
        $payment_method = PaymentMethod::find($id);
        $payment_method->name = $details['name'];
        $payment_method->status = $details['status'];
        $payment_method->user_id = $details['user_id'];
        $check_duplicate_name = PaymentMethod::where('user_id', $details['user_id'])
                                            ->where('id', '!=', $id)
                                            ->where('name', $details['name'])
                                            ->get();
        if (count($check_duplicate_name) > 0) {
            return;
        }
        if ($details['status'] === 'Active') {
            PaymentMethod::where('user_id', $details['user_id'])
                                        ->where('status', 'Active')
                                        ->update(['status' => 'No']);
        }
        return $payment_method->save();
    }

    public function deletePaymentMethod($id) 
    {
       return PaymentMethod::find($id)->delete();
    }
}
