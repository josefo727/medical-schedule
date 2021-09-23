<?php

namespace App\Providers;

use App\Models\MedicalAppointment;
use App\Observers\MedicalAppointmentObserver;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Paginator::useBootstrap();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        MedicalAppointment::observe(MedicalAppointmentObserver::class);
    }
}
