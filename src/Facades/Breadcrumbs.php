<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Breadcrumbs\Facades;

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
