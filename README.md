# Laravel Admin Panel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/juliomotol/laravel-admin-panel.svg?style=flat-square)](https://packagist.org/packages/juliomotol/laravel-admin-panel)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/juliomotol/laravel-admin-panel/run-tests?label=tests)](https://github.com/juliomotol/laravel-admin-panel/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/juliomotol/laravel-admin-panel/Check%20&%20fix%20styling?label=code%20style)](https://github.com/juliomotol/laravel-admin-panel/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/juliomotol/laravel-admin-panel.svg?style=flat-square)](https://packagist.org/packages/juliomotol/laravel-admin-panel)

A simple [CoreUI](https://coreui.io/) admin panel template with sidebar navigation management.

## Installation

You can install the package via composer:

```bash
composer require juliomotol/laravel-admin-panel
```

After installing, publish its assets using the `admin-panel:install` Artisan command.

```bash
php artisan admin-panel:install
```

> Add a `--no-assets` option if you want to [build your own assets](#build-your-own-assets).

If you prefer to use the provided assets you should publish the assets with:

```bash
@php artisan vendor:publish --tag=admin-panel-assets
```

To keep the assets up-to-date and avoid issues in future updates, we **highly recommend** adding the command to the `post-autoload-dump` scripts in your `composer.json` file:

```json
"scripts": {
    "post-update-cmd": [
        "@php artisan vendor:publish --tag=laravel-assets --ansi --force",
        "@php artisan vendor:publish --tag=admin-panel-assets --ansi --force"
    ]
}
```

Include the assets by adding the following Blade directives in the head tag, and before the end body tag in your template.

```html
<html>
    <head>
        ... @adminPanelStyle
    </head>
    <body>
        ... @adminPanelScript
    </body>
</html>
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-admin-panel-config"
```

This is the contents of the published config file:

```php
return [
];
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="laravel-admin-panel-views"
```

## Usage

### Adding the component to your template

In your template:

```html
<x-admin-panel-component>
    <!-- your mark up -->
</x-admin-panel-component>
```

You can add your own brand logos to the sidebar and header (only visible in mobile view) with:

```html
<x-admin-panel-component>
    <x-slot:sidebarBrand :src="asset('logo.png')"></x-slot>
    <x-slot:headerBrand :src="asset('logo.png')"></x-slot>
    <!-- your mark up -->
</x-admin-panel-component>
```

> Any additional attributes will be passed to their respective `<img>` tags.

> The `<x-slot:headerBrand>` slot can also accept an `href` attribute that will be passed to the `<a>` tag enclosing the logo.

You can add your own footer with:

```html
<x-admin-panel-component>
    <!-- your mark up -->
    <x-slot:footer>
        <div>
            Copyright &copy; {{ date('Y') }}
        </div>
    </x-slot>
</x-admin-panel-component>
```

### Sidebar & Account Navigation

In your `AdminPanelServiceProvider`, you can build your sidebar and account dropdown navigation by:

```php
class AdminPanelServiceProvider extends AdminPanelApplicationServiceProvider
{
    protected function build(AdminPanelManager $adminPanel): void
    {
        $adminPanel->sidebar()
            ->addItem('Dashboard', 'admin.dashboard')
            ->addGroup(
                'Access',
                fn (NavigationGroup $group) => $group
                    ->addItem(
                        'Users',
                        callback: fn (NavigationItem $item) => $item
                            ->additem('Admin', 'admin.users.admins.index')
                            ->additem('Clients', 'admin.users.clients.index')
                    )
                    ->addItem('Roles', 'admin.roles')
            );

        $adminPanel->account()
            ->addItem('My Profile', 'admin.my-profile.index');
            ->addItem('Logout', 'auth.logout');

        $adminPanel->setAccountAvatarResolver(fn () => Auth::user()->avatar())
    }
}
```

#### Adding Navigation Items

You can further customize the navigation item with by passing a closure:

```php
$adminPanel->sidebar()
    /**
     * @param string    $title      
     * @param ?string   $route      Can either be a named route or a url
     * @param array     $parameters The parameters for the named route
     * @param \Closure  $callback
     */
    ->addItem('Inquiries', 'admin.inquiries', callback: fn (NavigationItem $item) => ...)
```

> The `NavigationItem` uses Laravel's `Conditionable` trait. You can use `when()` and `unless()` methods to customize it.

You can add an icon class with:

```php
$adminPanel->sidebar()
    ->addItem(
        'Inquiries',
        'admin.inquiries',
        callback: fn (NavigationItem $item) =>$item->withIconClass('cil-notes')
    );
```

> The assets comes bundled with [CoreUI Icons](https://icons.coreui.io/icons/).

> **NOTE: The icon will not be shown in the account dropdown.**

You can add a badge with:

```php
$adminPanel->sidebar()
    ->addItem(
        'Inquiries',
        'admin.inquiries',
        callback: fn (NavigationItem $item) =>$item->withBadge(
            /**
             * @param string|\Closure   $title
             * @param BadgeStyle        $style
             */
            Badge::make(
                fn() => Inquiries::isUnread()->count(), // Also accepts a string
                BadgeStyle::SUCCESS
            )
        )
    );
```

> Available badge styles are:
> ```php
> BadgeStyle::PRIMARY
> BadgeStyle::SECONDARY
> BadgeStyle::INFO
> BadgeStyle::SUCCESS
> BadgeStyle::WARNING
> BadgeStyle::ERROR
> ```

You can also add a dropdown with:

```php
$adminPanel->sidebar()
    ->addItem(
        'Inquiries',
        'admin.inquiries',
        callback: fn (NavigationItem $item) =>$item->addItem(...)
    );
```

> **NOTE: The dropdown will only be shown in the sidebar. No icons will be show to the dropdown items either.**

#### Adding Navigation Groups

You can add items within the navigation group with by passing a closure:

```php
$adminPanel->sidebar()
    /**
     * @param string    $title      The title shown for this navigation group
     * @param \Closure  $callback   A closure to modify
     */
    ->addGroup(
        'CMS',
        fn (NavigationGroup $group) => $group->addItem('Pages', 'admin.pages')
            ->addItem('Blocks', 'admin.blocks')
            ->addItem('Meta', 'admin.meta')
    );
```

> The `NavigationGroup` uses Laravel's `Conditionable` trait. You can use `when()` and `unless()` methods to conditionaly add items.

#### Setting an Account Avatar

You can display a different account avatar with:

```php
$adminPanel->setAccountAvatarResolver(fn () => Auth::user()->avatar());
```

### Build your own assets

A set sensible default assets is provided to you, but if you want to implement your own build steps, during `admin-panel:install`, add a `--no-assets` option:

```bash
php artisan admin-panel:install --no-assets
```

Then install the asset deps via NPM:

```bash
npm install @coreui/coreui @coreui/icons @coreui/utils simplebar --save-dev
```

See the [`/assets`](assets/) as a starting ground for your assets.

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://github.com/spatie/.github/blob/main/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

-   [Julio Motol](https://github.com/juliomotol)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
