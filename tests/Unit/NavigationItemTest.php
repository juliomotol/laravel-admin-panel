<?php

use Illuminate\Support\Facades\Route;
use JulioMotol\AdminPanel\Navigation\Badge;
use JulioMotol\AdminPanel\Navigation\BadgeStyle;
use JulioMotol\AdminPanel\Navigation\NavigationItem;

use function PHPUnit\Framework\assertSame;

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

    $item->addDropdownItem('Bar', '/bar', callback: fn (NavigationItem $item) => $item->setAttribute('icon', 'bar'));

    assertSame('Bar', $item->dropdownItems()[0]->title);
    assertSame('/bar', $item->dropdownItems()[0]->route);
    assertSame('bar', $item->dropdownItems()[0]->attribute('icon'));
});

it('can add badge', function () {
    $item = new NavigationItem('Foo', '/foo');

    $item->withBadge(Badge::make('Foo', BadgeStyle::PRIMARY));

    assertSame('Foo', $item->badge->title);
    assertSame(BadgeStyle::PRIMARY, $item->badge->style);
});

it('can add attributes', function () {
    $item = new NavigationItem('Foo', '/foo');

    $item->setAttribute('icon', 'bar');

    assertSame('bar', $item->attribute('icon'));
});
