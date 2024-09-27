<?php

namespace App\Providers;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use App\Repositories\RelatorioRepositoryInterface;
use App\Repositories\RelatorioRepository;
use App\Repositories\AssuntoRepositoryInterface;
use App\Repositories\AssuntoRepository;
use App\Models\Autor;
use App\Models\Assunto;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->bind(AssuntoRepositoryInterface::class, AssuntoRepository::class);
        $this->app->bind(RelatorioRepositoryInterface::class, RelatorioRepository::class);
    }

    /**
     * Bootstrap any application services.
     */

    public function boot()
    {
        Route::model('autor', Autor::class);
        Route::bind('autor', function ($value) {
            return Autor::where('CodAu', $value)->firstOrFail();
        });
        

        Route::model('assunto', Assunto::class);
        Route::bind('assunto', function ($value) {
            return Assunto::where('CodAs', $value)->firstOrFail();
        });
        
        parent::boot();
    }
}
