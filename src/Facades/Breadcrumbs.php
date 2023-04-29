<?php

declare(strict_types=1);

namespace BombenProdukt\Breadcrumbs\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static void   for(string $name, callable $callback)
 * @method static array  generate(?string $name, array $parameters = [])
 * @method static string render(?string $name, array $parameters = [], string $view = 'full-width-bar')
 * @method static string renderWithView(?string $name, array $parameters, string $view)
 */
final class Breadcrumbs extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'breadcrumbs';
    }
}
