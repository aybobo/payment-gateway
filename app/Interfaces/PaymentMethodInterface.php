<?php

namespace App\Interfaces;

interface PaymentMethodInterface 
{
    public function getAllPaymentMethods();
    public function createPaymentMethod(array $details);
    public function getPaymentMethodById($id);
    public function updatePaymentMethod($id, array $details);
    public function deletePaymentMethod($id);
}