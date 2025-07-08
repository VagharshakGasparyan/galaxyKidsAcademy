<?php

namespace App\Providers;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
//        Collection::macro('paginate', function($perPage, $page = null, $options = []) {
//            $page = $page ?: (LengthAwarePaginator::resolveCurrentPage() ?: 1);
//            return new LengthAwarePaginator(
//                $this->forPage($page, $perPage),
//                $this->count(),
//                $perPage,
//                $page,
//                $options
//            );
//        });

        Collection::macro('paginate', function ($perPage = 15, $page = null, $options = []) {
            $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
            return new LengthAwarePaginator(
                $this->forPage($page, $perPage),
                $this->count(),
                $perPage,
                $page,
                [
                    'path' => Paginator::resolveCurrentPath(),
                    'query' => request()->query(),
                ] + $options
            );
        });

    }
}
