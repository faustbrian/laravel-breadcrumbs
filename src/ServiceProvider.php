<?php

declare(strict_types=1);

namespace BombenProdukt\Breadcrumbs;

use BombenProdukt\PackagePowerPack\Package\AbstractServiceProvider;
use Illuminate\Contracts\Foundation\Application;

final class ServiceProvider extends AbstractServiceProvider
{
    public function packageRegistered(): void
    {
        $this->app->singleton('breadcrumbs', fn (Application $app) => $app->make(Breadcrumbs::class));
    }
}
