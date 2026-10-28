<?php

namespace App\Providers;

use Dedoc\Scramble\Scramble;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

   
public function boot(): void
{
    Gate::define('viewApiDocs', function ($user = null) {
        return true;
    });

    Scramble::registerApi('default', [
        'api_path' => 'api',
        'api_domain' => null,
    ]);

   Scramble::registerUiRoute(
    path: 'docs/api',
    api: 'default',
    );
}

}
