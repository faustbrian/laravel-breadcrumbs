<?php

declare(strict_types=1);

namespace Tests\Unit;

use BombenProdukt\Breadcrumbs\Facades\Breadcrumbs;
use BombenProdukt\Breadcrumbs\Generator;
use Illuminate\Support\Facades\Route;
use function Pest\Laravel\get;

beforeEach(function (): void {
    Route::view('home', 'home')->name('home');
    Route::view('blog', 'blog')->name('blog');
    Route::get(
        'category/{category}',
        function () {
            return collect(Breadcrumbs::generate())->map->toArray()->toArray();
        },
    )->name('category');

    Breadcrumbs::for('home', function (Generator $trail): void {
        $trail->push('Home', route('home'));
    });

    Breadcrumbs::for('blog', function (Generator $trail): void {
        $trail->parent('home');
        $trail->push('Blog', route('blog'));
    });

    Breadcrumbs::for('category', function (Generator $trail, $category): void {
        $trail->parent('blog');
        $trail->push('Category', route('category', $category));
    });
});

it('should generate breadcrumbs for the current route', function (): void {
    get('category/123')
        ->assertSee('Home')
        ->assertSee('Blog')
        ->assertSee('Category');
});
