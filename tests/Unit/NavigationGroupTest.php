<?php

use JulioMotol\AdminPanel\Navigation\Badge;
use JulioMotol\AdminPanel\Navigation\BadgeStyle;
use JulioMotol\AdminPanel\Navigation\NavigationGroup;
use JulioMotol\AdminPanel\Navigation\NavigationItem;

use function PHPUnit\Framework\assertSame;

it('can make navigation group', function () {
    $group = new NavigationGroup('Foo');

    assertSame('Foo', $group->title);
});

it('can make add navigation item', function () {
    $group = new NavigationGroup('Foo');

    $group->addNavigation(
        'Foo',
        '/foo',
        callback: fn (NavigationItem $item) => $item->withBadge(Badge::make('Foo', BadgeStyle::PRIMARY))
    );

    assertSame('Foo', $group->items()[0]->title);
    assertSame('/foo', $group->items()[0]->route);
    assertSame('Foo', $group->items()[0]->badge->title);
    assertSame(BadgeStyle::PRIMARY, $group->items()[0]->badge->style);
});
