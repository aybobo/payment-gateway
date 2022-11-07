<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Interfaces\PaymentGatewayInterface;
use Illuminate\Http\Response;

class PaymentGatewayController extends Controller
{
    private PaymentGatewayInterface $gateway;

    public function __construct(PaymentGatewayInterface $gateway) 
    {
        $this->gateway = $gateway;
    }

    public function index()
    {
        $gateways = $this->orderRepository->getAllGateways();
        return view('gateways.index', ['gateways' => $gateways]);
    }

    public function store(Request $request) 
    {
        // $orderDetails = $request->only([
        //     'client',
        //     'details'
        // ]);

        $validated = $request->validate(['name' => 'required|unique:gatewats|min:8|max:50']);
        $gateway = [$request->input('name')];
        $this->gateway->createGateway($gateway);
        return redirect()->back();
    }

    public function show(Request $request)
    {
        $orderId = $request->route('id');

        return response()->json([
            'data' => $this->orderRepository->getOrderById($orderId)
        ]);
    }

    public function update(Request $request)
    {
        $orderId = $request->route('id');
        $orderDetails = $request->only([
            'client',
            'details'
        ]);

        return response()->json([
            'data' => $this->orderRepository->updateOrder($orderId, $orderDetails)
        ]);
    }

    public function destroy(Request $request) 
    {
        $orderId = $request->route('id');
        $this->orderRepository->deleteOrder($orderId);

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
