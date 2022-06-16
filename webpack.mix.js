
let mix = require('laravel-mix');

mix.setPublicPath('resources/dist')
    .setResourceRoot('../') // Turns assets paths in css relative to css file
    .sass('assets/sass/index.scss', 'css/index.css')
    .js('assets/js/index.js', 'js/index.js')
    .sourceMaps();