<?php

use JulioMotol\AdminPanel\Navigation\Badge;
use JulioMotol\AdminPanel\Navigation\BadgeStyle;
use JulioMotol\AdminPanel\Navigation\NavigationGroup;
use JulioMotol\AdminPanel\Navigation\NavigationItem;

use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertSame;
use function PHPUnit\Framework\assertTrue;

it('can make navigation group', function () {
    $group = new NavigationGroup('Foo');

    assertSame('Foo', $group->title);
});

it('can make add navigation item', function () {
    $group = new NavigationGroup('Foo');

    $group->addItem(
        'Foo',
        '/foo',
        callback: fn (NavigationItem $item) => $item->withBadge(Badge::make('Foo', BadgeStyle::PRIMARY))
    );

    assertSame('Foo', $group->items()[0]->title);
    assertSame('/foo', $group->items()[0]->route);
    assertSame('Foo', $group->items()[0]->badge->title);
    assertSame(BadgeStyle::PRIMARY, $group->items()[0]->badge->style);
});

it('is aware if it has items', function () {
    $group = new NavigationGroup('Foo');

    assertFalse($group->hasItems());

    $group->addItem('Foo', '/foo');

    assertTrue($group->hasItems());
});
