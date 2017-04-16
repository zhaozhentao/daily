const elixir = require('laravel-elixir');
require('laravel-elixir-livereload');
require('laravel-elixir-compress');

require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application as well as publishing vendor resources.
 |
 */


elixir(function (mix) {
    mix
        .copy([
            'node_modules/bootstrap-sass/assets/fonts/bootstrap'
        ], 'public/assets/fonts/bootstrap')

        .copy([
            'node_modules/font-awesome/fonts'
        ], 'public/assets/fonts/font-awesome')

        .sass([
            'app.scss'
        ], 'public/assets/css/styles.css')

        .version([
            'assets/css/styles.css'
        ])

    ;

    mix.compress();
});
