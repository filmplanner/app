var gulp = require('gulp');
var uglify = require('gulp-uglify');
var minifyCss = require('gulp-minify-css');
var concat = require('gulp-concat');

gulp.task('scripts', function() {
  gulp.src(['node_modules/jquery/dist/jquery.js',
            'node_modules/angular/angular.js',
            'node_modules/angular-route/angular-route.js',
            'node_modules/angular-cookies/angular-cookies.min.js',
            'assets/js/core/*.js',
            'assets/js/angular/*.js',
            'assets/js/functions.js'
          ])
  .pipe(concat('app.js'))
  .pipe(uglify())
  .pipe(gulp.dest('build/js'));
});

gulp.task('styles', function() {
  gulp.src(['assets/css/semantic.min.css',
            'assets/css/modal.css',
            'assets/css/icon.min.css',
            'assets/css/owl.carousel.css',
            'assets/css/owl.transitions.css',
            'assets/css/template.css',
          ])
  .pipe(minifyCss())
  .pipe(concat('app.css'))
  .pipe(gulp.dest('build/css'));
});
