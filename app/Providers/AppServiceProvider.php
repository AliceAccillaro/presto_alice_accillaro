<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Paginator::defaultView('vendor.pagination.presto');
        Paginator::defaultSimpleView('vendor.pagination.presto-simple');

        if (Schema::hasTable('categories')) {
            View::share('categories', Category::orderBy('name')->get());
        }
    }
}
