const mix = require('laravel-mix');

mix.copy('node_modules/@fortawesome/fontawesome-free/webfonts', 'public/webfonts', false);
mix.copy('resources/fonts', 'public/fonts', false);

mix.js('resources/js/app.js', 'public/js');
    // .postCss('resources/css/app.css', 'public/css', [
    //     //
    // ]);

// mix.sass('resources/sass/app.scss', 'public/css');

// mix.js('resources/js/app.js', 'public/js')
//     .vue()
//     .sass('resources/sass/app.scss', 'public/css')
//     .sass('node_modules/@fortawesome/fontawesome-free/scss/fontawesome.scss', 'public/css')
    // .style();

// mix.js('resources/js/app.js', 'public/js')
//     .vue()
//     .sass('resources/sass/app.scss', 'public/css');

mix.combine([
    'node_modules/normalize.css/normalize.css',
    'node_modules/bootstrap/dist/css/bootstrap.min.css',
    'node_modules/select2/dist/css/select2.min.css',
    'node_modules/admin-lte/dist/css/adminlte.min.css',
    'node_modules/@fortawesome/fontawesome-free/css/all.min.css',
    'node_modules/toastr/build/toastr.min.css',
    'resources/css/app.css',
    'resources/css/selecting-columns.css',
    // 'resources/repos/boostrap-datepicker/dist/css/bootstrap-datepicker.min.css',
], 'public/css/styles.css');

mix.combine([
    'node_modules/admin-lte/dist/js/adminlte.min.js',

    // 'node_modules/vue/dist/vue.min.js',

    'node_modules/moment/min/moment-with-locales.min.js',

    'node_modules/chart.js/dist/chart.min.js',
    'node_modules/chartjs-plugin-datalabels/dist/chartjs-plugin-datalabels.min.js',

    'node_modules/select2/dist/js/select2.min.js',
    'node_modules/select2/dist/js/i18n/en.js',
    'node_modules/select2/dist/js/i18n/pl.js',

    // 'resources/repos/boostrap-datepicker/dist/js/bootstrap-datepicker.min.js',
    'resources/js/prototypes.js',
    'resources/js/callback.js',
    'resources/js/onload.js',
    'resources/js/scripts.js',
    // 'resources/js/vue.js',

    'resources/js/charts-utils.js',
    'resources/js/charts.js',
], 'public/js/scripts.js');

// mix.combine([
//     'resources/js/app.js',
// ], 'public/js/app.js');
