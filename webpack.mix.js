const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
    ]).browserSync('http://localhost:8000');
/* CSS */
// mix.sass('frontend/resources/sass/main.scss', 'frontend/public/css/codebase.css')
//     .sass('frontend/resources/sass/codebase/themes/corporate.scss', 'frontend/resources/public/css/themes/')
//     .sass('frontend/resources/sass/codebase/themes/earth.scss', 'frontend/resources/public/css/themes/')
//     .sass('frontend/resources/sass/codebase/themes/elegance.scss', 'frontend/resources/public/css/themes/')
//     .sass('frontend/resources/sass/codebase/themes/flat.scss', 'frontend/resources/public/css/themes/')
//     .sass('frontend/resources/sass/codebase/themes/pulse.scss', 'frontend/resources/public/css/themes/')
//
//     /* JS */
//     .js('frontend/resources/js/app.js', 'frontend/resources/public/js/laravel.app.js')
//     .js('frontend/resources/js/codebase/app.js', 'frontend/resources/public/js/codebase.app.js')
mix.disableNotifications();




