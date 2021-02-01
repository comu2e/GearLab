<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class MessageServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer(
            '*', 'App\Http\Composers\MessageComposer'
        );
    }

    public function register()
    {
        //
    }
}
