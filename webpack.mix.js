
let mix = require('laravel-mix');

mix.setPublicPath('resources/dist')
    .setResourceRoot('../') // Turns assets paths in css relative to css file
    .sass('assets/sass/index.scss', 'css/index.css')
    .js(['node_modules/@coreui/coreui/dist/js/coreui.bundle.js', 'node_modules/simplebar/dist/simplebar.min.js'], 'js/index.js')
    .sourceMaps();