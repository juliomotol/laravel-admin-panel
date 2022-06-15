<?php

use JulioMotol\AdminPanel\Facades\AdminPanel;
use JulioMotol\AdminPanel\Navigation\Badge;
use JulioMotol\AdminPanel\Navigation\BadgeStyle;
use JulioMotol\AdminPanel\Navigation\NavigationGroup;
use JulioMotol\AdminPanel\Navigation\NavigationItem;

it('can test', function () {
    /** @var \JulioMotol\AdminPanel\NavigationStack */
    $sidebar = AdminPanel::sidebar();

    $sidebar->addNavigation('Dashboard', '/')
        ->addGroup(
            'CMS',
            fn (NavigationGroup $group) => $group
                ->addNavigation('Pages', '/pages')
                ->addNavigation('News', '/news')
        )
        ->addGroup(
            'Order',
            fn (NavigationGroup $group) => $group
                ->addNavigation(
                    'Orders',
                    '/order',
                    fn (NavigationItem $item) => $item->withBadge(Badge::make(10, BadgeStyle::SUCCESS))
                )
                ->addNavigation('Payments', '/payments')
        )
        ->addGroup(
            'Access',
            fn (NavigationGroup $group) => $group
                ->addNavigation(
                    'Users',
                    '/users',
                    fn (NavigationItem $item) => $item
                        ->addDropdownItem('Admin', '/users/admins')
                        ->addDropdownItem('Clients', '/users/clients')
                )
                ->addNavigation('Roles', '/news')
        );

    // dd($sidebar);

    expect(true)->toBeTrue();
});
