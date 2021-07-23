<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator; //ペジネータ名前空間を追加

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //ペジネーションデフォルト対応
        Paginator::useBootstrapThree();

        // HTTP通信プロトコルをHTTPSに変換
        if (\App::environment('production')) {
            \URL::forceScheme('https');
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
