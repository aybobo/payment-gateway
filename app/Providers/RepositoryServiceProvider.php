<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Interfaces\PaymentGatewayInterface;
use App\Repositories\GatewayRepository;
use App\Interfaces\PaymentMethodInterface;
use App\Repositories\PaymentMethodRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PaymentGatewayInterface::class, GatewayRepository::class);
        $this->app->bind(PaymentMethodInterface::class, PaymentMethodRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
