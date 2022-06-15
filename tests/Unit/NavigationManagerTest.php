<?php

use JulioMotol\AdminPanel\Navigation\Badge;
use JulioMotol\AdminPanel\Navigation\BadgeStyle;
use JulioMotol\AdminPanel\Navigation\NavigationGroup;
use JulioMotol\AdminPanel\Navigation\NavigationItem;
use JulioMotol\AdminPanel\Navigation\NavigationManager;

use function PHPUnit\Framework\assertInstanceOf;
use function PHPUnit\Framework\assertSame;

it('can make navigation manager', function () {
    $manager = new NavigationManager();

    assertInstanceOf(NavigationManager::class, $manager);
});

it('can make add navigation item', function () {
    $manager = new NavigationManager('Foo');

    $manager->addNavigation(
        'Foo',
        '/foo',
        callback: fn (NavigationItem $item) => $item->withBadge(Badge::make('Foo', BadgeStyle::PRIMARY))
    );

    assertSame('Foo', $manager->items()[0]->title);
    assertSame('/foo', $manager->items()[0]->route);
    assertSame('Foo', $manager->items()[0]->badge->title);
    assertSame(BadgeStyle::PRIMARY, $manager->items()[0]->badge->style);
});

it('can make add navigation group', function () {
    $manager = new NavigationManager('Foo');

    $manager->addGroup(
        'Foo',
        fn (NavigationGroup $group) => $group->addNavigation(
            'Foo',
            '/foo',
            callback: fn (NavigationItem $item) => $item->withBadge(Badge::make('Foo', BadgeStyle::PRIMARY))
        )
    );

    assertSame('Foo', $manager->groups()[0]->title);
    assertSame('Foo', $manager->groups()[0]->items()[0]->title);
    assertSame('/foo', $manager->groups()[0]->items()[0]->route);
    assertSame('Foo', $manager->groups()[0]->items()[0]->badge->title);
    assertSame(BadgeStyle::PRIMARY, $manager->groups()[0]->items()[0]->badge->style);
});
