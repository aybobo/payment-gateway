<?php

namespace App\Repositories;

use App\Interfaces\PaymentGatewayInterface;
use App\Models\Gateway;

class GatewayRepository implements PaymentGatewayInterface 
{
    public function getAllGateways() 
    {
        return Gateway::all();
    }

    public function createGateway(array $details)
    {
        return Gateway::create($details);
    }

    public function getGatewayById($id)
    {
        return Gateway::findOrFail($id);
    }

    public function updateGateway($id, array $details)
    {
        $gateway = Gateway::find($id);
        $gateway->name = $details['name'];
        $gateway->status = $details['status'];
        $check_duplicate_name = Gateway::where('id', '!=', $id)
                                        ->where('name', $details['name'])
                                        ->get();
        if (count($check_duplicate_name) > 0) {
            return;
        }
        return $gateway->save();
    }

    public function deleteGateway($id) 
    {
       return Gateway::find($id)->delete();
    }
}
