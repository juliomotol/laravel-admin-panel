<?php

use JulioMotol\AdminPanel\Navigation\Badge;
use JulioMotol\AdminPanel\Navigation\BadgeStyle;

use function PHPUnit\Framework\assertSame;

it('can make badge', function () {
    $badge = Badge::make('Foo', BadgeStyle::PRIMARY);

    assertSame('Foo', $badge->title);
    assertSame(BadgeStyle::PRIMARY, $badge->style);
});
