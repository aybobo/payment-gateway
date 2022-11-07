<?php

namespace App\Interfaces;

interface PaymentGatewayInterface 
{
    public function getAllGateways();
    public function createGateway(array $details);
    public function getGatewayById($id);
    public function updateGateway($id, array $details);
    public function deleteGateway($id);
}