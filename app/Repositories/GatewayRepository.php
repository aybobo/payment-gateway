<?php

namespace App\Repositories;

use App\Interfaces\PaymentGatewayInterface;
use App\Models\Gateway;
use Illuminate\Support\Facades\DB;

class GatewayRepository implements PaymentGatewayInterface 
{
    public function getAllGateways() 
    {
        return Gateway::all();
    }

    public function createGateway(array $details)
    {
        //return Gateway::create($details);

        $gateway = new Gateway;
        $gateway->name = $details['name'];
        return $gateway->save();
    }

    public function getGatewayById($id)
    {
        return Gateway::findOrFail($id);
    }

    public function updateGateway($id, array $details)
    {
        //return Gateway::whereId($id)->update($details);

        $gateway = Gateway::find($id);
        $gateway->name = $details['name'];
        $gateway->status = $details['status'];
        if ($details['status'] === 'Yes') {
            DB::table('gateways')->where('status', 'Yes')->update(['status' => 'No']);
        }
        return $gateway->save();
    }

    public function deleteGateway($id) 
    {
       return Gateway::find($id)->delete();
    }
}
