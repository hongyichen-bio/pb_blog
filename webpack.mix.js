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

// mix.js('resources/js/app.js', 'public/js')
//     .postCss('resources/css/app.css', 'public/css', [
//         //
//     ]);

    
// mix.js('resources/js/app.js', 'public/js')
// .sass('resources/css/app.scss', 'public/css')

// .sass('resources/css/main.scss', 'public/css');

// Plain CSS 把CSS壓縮最小化(可以把很多個CSS壓縮成一個檔案,可以減少request的數目)
// mix.styles([
//     'resources/css/a.css',
//     'resources/css/b.css',
//     'resources/css/c.css',
// ],'public/css/abc.min.css')
// .copyDirectory('resources/imgs','public/imgs')

mix.js('resources/js/app.js', 'public/js')
.sass('resources/css/app.scss', 'public/css')
.version()