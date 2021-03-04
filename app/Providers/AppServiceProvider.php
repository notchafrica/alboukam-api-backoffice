<?php

namespace App\Providers;

use App\Models\Admin;
use Illuminate\Support\ServiceProvider;
use Orchid\Platform\Models\User;
use Orchid\Support\Facades\Dashboard;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        //Dashboard::useModel(\Orchid\Platform\Models\User::class, Admin::class);
        Dashboard::configure([
            'models' => [
                User::class => Admin::class,
            ],
        ]);
    }
}
