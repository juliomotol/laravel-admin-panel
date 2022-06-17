<?php

use Illuminate\Support\Facades\Route;
use JulioMotol\AdminPanel\Navigation\Badge;
use JulioMotol\AdminPanel\Navigation\BadgeStyle;
use JulioMotol\AdminPanel\Navigation\NavigationItem;

use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertSame;
use function PHPUnit\Framework\assertTrue;

it('can make navigation item', function () {
    $item = new NavigationItem('Foo', '/foo');

    assertSame('Foo', $item->title);
    assertSame('/foo', $item->route);
});

it('can make navigation item w/ named route', function () {
    Route::get('/foo/{foo}', fn () => 'foo')->name('foo');
    Route::getRoutes()->refreshNameLookups();

    $item = new NavigationItem('Foo', 'foo', ['foo' => 'bar']);

    assertSame('Foo', $item->title);
    assertSame(route('foo', ['foo' => 'bar']), $item->route());
});

it('can add dropdown', function () {
    $item = new NavigationItem('Foo', '/foo');

    $item->addItem('Bar', '/bar', callback: fn (NavigationItem $item) => $item->withIconClass('bar'));

    assertSame('Bar', $item->items()[0]->title);
    assertSame('/bar', $item->items()[0]->route);
    assertSame('bar', $item->items()[0]->icon_class);
});

it('can add badge', function () {
    $item = new NavigationItem('Foo', '/foo');

    $item->withBadge(Badge::make('Foo', BadgeStyle::PRIMARY));

    assertSame('Foo', $item->badge->title);
    assertSame(BadgeStyle::PRIMARY, $item->badge->style);
});

it('can add icon class', function () {
    $item = new NavigationItem('Foo', '/foo');

    $item->withIconClass('bar');

    assertSame('bar', $item->icon_class);
});

it('is aware if it has items', function () {
    $item = new NavigationItem('Foo', '/foo');

    assertFalse($item->hasItems());

    $item->addItem('Foo', '/foo');

    assertTrue($item->hasItems());
});
