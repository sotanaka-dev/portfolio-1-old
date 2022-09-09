<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewComposeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('livewire.components.total-amount-in-cart', 'App\Http\Composers\AmountComposer');
        View::composer('livewire.order', 'App\Http\Composers\AmountComposer');
        View::composer('emails.order', 'App\Http\Composers\AmountComposer');
    }
}
