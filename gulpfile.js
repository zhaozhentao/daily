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

var basejs = [
    'resources/assets/js/vendor/jquery.min.js',
    'resources/assets/js/vendor/bootstrap.min.js',
    'resources/assets/js/vendor/moment.min.js',
    'resources/assets/js/vendor/zh-cn.min.js',
    'resources/assets/js/vendor/emojify.min.js',
    'resources/assets/js/vendor/jquery.scrollUp.js',
    'resources/assets/js/vendor/jquery.pjax.js',
    'resources/assets/js/vendor/nprogress.js',
    'resources/assets/js/vendor/jquery.autosize.min.js',
    'resources/assets/js/vendor/prism.js',
    'resources/assets/js/vendor/jquery.textcomplete.js',
    'resources/assets/js/vendor/emoji.js',
    'resources/assets/js/vendor/marked.min.js',
    'resources/assets/js/vendor/ekko-lightbox.js',
    'resources/assets/js/vendor/localforage.min.js',
    'resources/assets/js/vendor/jquery.inline-attach.min.js',
    'resources/assets/js/vendor/snowfall.jquery.min.js',
    'resources/assets/js/vendor/upload-image.js',
    'resources/assets/js/vendor/bootstrap-switch.js',
    'resources/assets/js/vendor/messenger.js',
    'resources/assets/js/vendor/anchorific.js',
    'resources/assets/js/vendor/analytics.js',
    'resources/assets/js/vendor/jquery.jscroll.js',
    'resources/assets/js/vendor/jquery.highlight.js',
    'node_modules/sweetalert/dist/sweetalert.min.js',
    'node_modules/social-share.js/dist/js/social-share.min.js',
];

elixir(function (mix) {
    mix
        .copy([
            'node_modules/bootstrap-sass/assets/fonts/bootstrap'
        ], 'public/assets/fonts/bootstrap')

        .copy([
            'node_modules/font-awesome/fonts'
        ], 'public/assets/fonts/font-awesome')

        .copy([
            'resources/assets/img'
        ], 'public/assets/img')

        .sass([
            'base.scss',
            'app.scss',
            'my.scss',
        ], 'public/assets/css/styles.css')

        .scripts(basejs.concat([
            'resources/assets/js/app.js',
        ]), 'public/assets/js/scripts.js', './')

        // editor
        .scripts([
            'vendor/inline-attachment.js',
            'vendor/codemirror-4.inline-attachment.js',
            'vendor/simplemde.min.js',
        ], 'public/assets/js/editor.js')

        // API Web View
        .sass([
            'vendor/simplemde.min.scss'
        ], 'public/assets/css/editor.css')

        .version([
            'assets/css/styles.css'
        ])

    ;

    mix.compress();
});
