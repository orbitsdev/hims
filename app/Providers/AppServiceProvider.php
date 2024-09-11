<?php

namespace App\Providers;


use App\Services\RouteManager;
use App\Broadcasting\SmsChannel;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Filament\Support\Facades\FilamentColor;
use Filament\Support\View\Components\Modal;
use Illuminate\Notifications\ChannelManager;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton('routemanager', function ($app) {
            return new RouteManager();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
        Model::unguard();

        FilamentColor::register([
            'primary' => "#064f32",
            'tory-blue' => [
                '50' => '#f0f7ff',
                '100' => '#e0edfe',
                '200' => '#b9dbfe',
                '300' => '#7bbffe',
                '400' => '#369ffa',
                '500' => '#0b82ec',
                '600' => '#0065c9',
                '700' => '#014fa1',
                '800' => '#054487',
                '900' => '#0b3a6f',
                '950' => '#07244a',
            ],
            'kaitoke-green' => [
    '50'  => '#edfff7',
    '100' => '#d6ffed',
    '200' => '#afffdc',
    '300' => '#71ffc3',
    '400' => '#2cfca3',
    '500' => '#01e684',
    '600' => '#00bf6a',
    '700' => '#009657',
    '800' => '#067547',
    '900' => '#064f32',
    '950' => '#003620',
],




        ]);

        Modal::closedByClickingAway(false);
        $this->app->make(ChannelManager::class)->extend('sms', function ($app) {
            return new SmsChannel();
        });


    }
}
