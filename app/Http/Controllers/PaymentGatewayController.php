<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\PaymentGatewayInterface;

class PaymentGatewayController extends Controller
{
    private PaymentGatewayInterface $gateway;

    public function __construct(PaymentGatewayInterface $gateway) 
    {
        $this->middleware(['auth','verified']);
        $this->gateway = $gateway;
    }

    public function index()
    {
        $gateways = $this->gateway->getAllGateways();
        return view('gateways.index', ['gateways' => $gateways]);
    }

    public function store(Request $request) 
    {
        $validated = $request->validate(['name' => 'required|unique:gateways|min:3|max:20']);
        $details = $request->only(['name']);
        $this->gateway->createGateway($details);
        $request->session()->flash('message', 'Payment gateway created');
        return redirect()->route('index.payment.gateway');
    }

    public function show(Request $request)
    {
        $id = $request->route('id');
        $gateway = $this->gateway->getGatewayById($id);
        return view('gateways.edit', ['gateway' => $gateway]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:3|max:20',
            'status' => 'required',
        ]);
        $id = $request->route('id');
        $details = $request->only([
            'name',
            'status',
        ]);
        $this->gateway->updateGateway($id, $details);
        $request->session()->flash('message', 'Payment gateway updated');
        return redirect()->route('index.payment.gateway');
    }

    public function destroy(Request $request) 
    {
        $id = $request->route('id');
        $this->gateway->deleteGateway($id);
        $request->session()->flash('message', 'Payment method deleted');
        return redirect()->back();
    }
}
