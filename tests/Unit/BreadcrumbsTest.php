<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Tests\Unit;

use BaseCodeOy\Breadcrumbs\Facades\Breadcrumbs;
use BaseCodeOy\Breadcrumbs\Generator;
use Illuminate\Support\Facades\Route;
use function Spatie\Snapshots\assertMatchesHtmlSnapshot;

beforeEach(function (): void {
    Route::view('home', 'home')->name('home');
    Route::view('blog', 'blog')->name('blog');
    Route::view('category/{category}', 'category')->name('category');

    Breadcrumbs::for('home', function (Generator $trail): void {
        $trail->push('Home', route('home'));
    });

    Breadcrumbs::for('blog', function (Generator $trail): void {
        $trail->parent('home');
        $trail->push('Blog', route('blog'));
    });

    Breadcrumbs::for('category', function (Generator $trail, $category): void {
        $trail->parent('blog');
        $trail->push($category->title, route('category', $category->id));
    });
});

it('should generate an array representation of the breadcrumb', function (): void {
    $breadcrumbs = Breadcrumbs::generate('category', ['category' => (object) ['id' => 123, 'title' => 'Guides']]);

    expect(collect($breadcrumbs)->map->toArray()->toArray())->toBe([
        [
            'name' => 'Home',
            'link' => 'http://localhost/home',
        ],
        [
            'name' => 'Blog',
            'link' => 'http://localhost/blog',
        ],
        [
            'name' => 'Guides',
            'link' => 'http://localhost/category/123',
        ],
    ]);
});

it('should render the breadcrumbs as HTML', function (string $view): void {
    assertMatchesHtmlSnapshot(Breadcrumbs::render('category', ['category' => (object) ['id' => 123, 'title' => 'Guides']], $view));
})->with([
    'contained',
    'full-width-bar',
    'simple-with-chevrons',
    'simple-with-slashes',
]);
