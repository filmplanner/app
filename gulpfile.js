var gulp = require('gulp');
var uglify = require('gulp-uglify');
var minifyCss = require('gulp-minify-css');
var concat = require('gulp-concat');

gulp.task('scripts', function() {
  gulp.src(['node_modules/jquery/dist/jquery.js',
            'node_modules/angular/angular.js',
            'node_modules/angular-route/angular-route.js',
            'node_modules/angular-cookies/angular-cookies.min.js',
            'js/core/*.js',
            'js/angular/*.js',
            'js/functions.js'
          ])
  .pipe(concat('app.js'))
  .pipe(uglify())
  .pipe(gulp.dest('build/js'));
});

gulp.task('styles', function() {
  gulp.src(['css/semantic.min.css',
            'css/modal.css',
            'css/icon.min.css',
            'css/owl.carousel.css',
            'css/owl.transitions.css',
            'css/template.css',
          ])
  .pipe(minifyCss())
  .pipe(concat('app.css'))
  .pipe(gulp.dest('build/css'));
});
