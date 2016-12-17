// const elixir = require('laravel-elixir');

// require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

// elixir(mix => {
//     mix.sass('app.scss')
//        .webpack('app.js');
// });

const gulp = require('gulp');
const babel = require('gulp-babel');

gulp.task('default', function() {

    gulp.src('resources/assets/js/breakfast/**/*.js')
        .pipe(gulp.dest('public/js/dist'));

    gulp.watch('resources/assets/js/breakfast/**/*.js')
        .on('change', function() {
            gulp.src('resources/assets/js/breakfast/**/*.js')
                .pipe(gulp.dest('public/js/dist'));
        });

});
