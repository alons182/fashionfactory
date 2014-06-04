var gulp        = require('gulp'),
    uglify      = require('gulp-uglify'),
    changed     = require('gulp-changed'),
    stripDebug  = require('gulp-strip-debug'),
    browserify  = require('gulp-browserify'),
    imagemin    = require('gulp-imagemin'),
    stripDebug  = require('gulp-strip-debug'),
    minifyCSS   = require('gulp-minify-css'),
    minifyHTML  = require('gulp-minify-html'),
    concat = require('gulp-concat');


gulp.task('js', function () {
  gulp.src([
    './public/js/vendor/jquery-1.11.0.min.js',
    './public/js/vendor/jquery.isotope.min.js',
    './public/js/vendor/jquery.contentcarousel.js',
    './public/js/vendor/jquery.touchSwipe.min.js',
    './public/js/vendor/jquery.easing.1.3.js',
    './public/js/vendor/jquery.mousewheel.min.js',
    './public/js/vendor/imagesloaded.min.js',
    './public/js/vendor/lightbox.min.js',
    './public/js/main.js'
   
    ])
    //.pipe(browserify())
    .pipe(uglify({ compress: true }))
    .pipe(stripDebug())
    .pipe(concat('bundle.js'))
    .pipe(gulp.dest('./public/js'));
 
});

gulp.task('js_admin', function () {
  gulp.src([
    './public/js/vendor/jquery-1.11.0.min.js',
    './public/js/vendor/handlebars-v1.3.0.js',
    './public/js/vendor/lightbox.min.js',
    './public/js/vendor/ajaxupload.js',
    './public/js/admin.js'
   
    ])
    //.pipe(browserify())
    .pipe(uglify({ compress: true }))
    .pipe(stripDebug())
    .pipe(concat('bundle_admin.js'))
    .pipe(gulp.dest('./public/js'));
 
});

gulp.task('css', function () {
  gulp.src(['./public/css/isotope.css','./public/css/lightbox.css','./public/css/main.css'])
    .pipe(minifyCSS({ keepSpecialComments: '*', keepBreaks: '*'}))
    .pipe(concat('bundle.css'))
    .pipe(gulp.dest('./public/css'));
});

gulp.task('css_admin', function () {
  gulp.src(['./public/css/lightbox.css','./public/css/admin.css'])
    .pipe(minifyCSS({ keepSpecialComments: '*', keepBreaks: '*'}))
    .pipe(concat('bundle_admin.css'))
    .pipe(gulp.dest('./public/css'));
});

gulp.task('watch', function () {
   gulp.watch(['./public/js/main.js'],['js']);
    gulp.watch(['./public/js/admin.js'],['js_admin']);
   gulp.watch(['./public/css/main.css'],['css']);
   gulp.watch(['./public/css/admin.css'],['css_admin']);
   
});

gulp.task('default', [ 'js','js_admin','css','css_admin', 'watch' ]);