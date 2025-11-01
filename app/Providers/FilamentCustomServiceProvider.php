<?php

namespace App\Providers;

use Filament\Support\Assets\Css;
use Filament\Support\Facades\FilamentAsset;
use Illuminate\Support\ServiceProvider;

class FilamentCustomServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Enregistrer les styles CSS personnalisés
        FilamentAsset::register([
            Css::make('filament-fixes', public_path('css/filament-fixes.css')),
        ]);
    }
}