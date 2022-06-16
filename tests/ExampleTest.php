<?php

use JulioMotol\AdminPanel\Facades\AdminPanel;
use JulioMotol\AdminPanel\Navigation\Badge;
use JulioMotol\AdminPanel\Navigation\BadgeStyle;
use JulioMotol\AdminPanel\Navigation\NavigationGroup;
use JulioMotol\AdminPanel\Navigation\NavigationItem;

it('can test', function () {
    /** @var \JulioMotol\AdminPanel\NavigationStack */
    $sidebar = AdminPanel::sidebar();

    $sidebar->addItem('Dashboard', '/')
        ->addGroup(
            'CMS',
            fn (NavigationGroup $group) => $group
                ->addItem('Pages', '/pages')
                ->addItem('News', '/news')
        )
        ->addGroup(
            'Order',
            fn (NavigationGroup $group) => $group
                ->addItem(
                    'Orders',
                    '/order',
                    fn (NavigationItem $item) => $item->withBadge(Badge::make(10, BadgeStyle::SUCCESS))
                )
                ->addItem('Payments', '/payments')
        )
        ->addGroup(
            'Access',
            fn (NavigationGroup $group) => $group
                ->addItem(
                    'Users',
                    '/users',
                    fn (NavigationItem $item) => $item
                        ->addItem('Admin', '/users/admins')
                        ->addItem('Clients', '/users/clients')
                )
                ->addItem('Roles', '/news')
        );

    // dd($sidebar);

    expect(true)->toBeTrue();
});
