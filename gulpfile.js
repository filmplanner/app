var gulp = require('gulp');
var uglify = require('gulp-uglify');
var minifyCss = require('gulp-minify-css');
var concat = require('gulp-concat');

gulp.task('core', function() {
  gulp.src(['node_modules/jquery/dist/jquery.js',
            'node_modules/angular/angular.js',
            'node_modules/angular-route/angular-route.js',
            'node_modules/angular-cookies/*.js',
            'node_modules/angular-owl-carousel-master/angular-owl-carousel.js',
            'js/core/*.js'
          ])
  .pipe(concat('core.js'))
  .pipe(uglify())
  .pipe(gulp.dest('build/js'));
});

gulp.task('scripts', function() {
  gulp.src(['js/angular/*.js',
            'js/functions.js',
          ])
  .pipe(concat('scripts.js'))
  .pipe(uglify())
  .pipe(gulp.dest('build/js'));
});

gulp.task('app', function() {
  gulp.src('build/js/*.js')
  .pipe(concat('app.js'))
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
  .pipe(concat('style.css'))
  .pipe(gulp.dest('build/css'));
});
