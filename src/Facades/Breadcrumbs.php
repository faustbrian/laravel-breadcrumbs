<?php

declare(strict_types=1);

namespace BombenProdukt\Breadcrumbs\Facades;

use Illuminate\Support\Facades\Facade;

final class Breadcrumbs extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'breadcrumbs';
    }
}
