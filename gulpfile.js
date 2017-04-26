const elixir = require('laravel-elixir');
const gulpLivereload = require('gulp-livereload');

require('laravel-elixir-vue-2');
require('laravel-elixir-livereload');

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

const gulp = require('gulp');
const babel = require('gulp-babel');
const util = require("gulp-util");


elixir(mix => {
    mix.webpack('app.js').webpack('order.js').livereload();
});


// gulp.task('default', function() {

//     gulp.src('resources/assets/js/breakfast/**/*.js')
//         .pipe(gulp.dest('public/js/dist'));

//     gulp.watch('resources/assets/js/breakfast/**/*.js')
//         .on('change', function() {
//             gulp.src('resources/assets/js/breakfast/**/*.js')
//                 .pipe(gulp.dest('public/js/dist'));
//         });

// });
