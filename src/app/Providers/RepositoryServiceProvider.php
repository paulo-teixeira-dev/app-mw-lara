<?php

namespace App\Providers;

use App\Interfaces\EletroRepositoryInterface;
use App\Interfaces\MarcaRepositoryInterface;
use App\Repositories\EletroRepository;
use App\Repositories\MarcaRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(EletroRepositoryInterface::class, EletroRepository::class);
        $this->app->bind(MarcaRepositoryInterface::class, MarcaRepository::class);
    }

    public function boot()
    {
        //
    }
}
