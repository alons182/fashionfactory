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
    './js/vendor/jquery-1.11.0.min.js',
    './js/vendor/jquery.isotope.min.js',
    './js/vendor/jquery.contentcarousel.js',
    './js/vendor/jquery.touchSwipe.min.js',
    './js/vendor/jquery.easing.1.3.js',
    './js/vendor/jquery.mousewheel.min.js',
    './js/vendor/imagesloaded.min.js',
    './js/vendor/lightbox.min.js',
    './js/main.js'
   
    ])
    //.pipe(browserify())
    .pipe(uglify({ compress: true }))
    .pipe(stripDebug())
    .pipe(concat('bundle.js'))
    .pipe(gulp.dest('./js'));
 
});

gulp.task('js_admin', function () {
  gulp.src([
    './js/vendor/jquery-1.11.0.min.js',
    './js/vendor/handlebars-v1.3.0.js',
    './js/vendor/lightbox.min.js',
    './js/vendor/ajaxupload.js',
    './js/admin.js'
   
    ])
    //.pipe(browserify())
    .pipe(uglify({ compress: true }))
    .pipe(stripDebug())
    .pipe(concat('bundle_admin.js'))
    .pipe(gulp.dest('./js'));
 
});

gulp.task('css', function () {
  gulp.src(['./css/isotope.css','./css/lightbox.css','./css/main.css'])
    .pipe(minifyCSS({ keepSpecialComments: '*', keepBreaks: '*'}))
    .pipe(concat('bundle.css'))
    .pipe(gulp.dest('./css'));
});

gulp.task('css_admin', function () {
  gulp.src(['./css/lightbox.css','./css/admin.css'])
    .pipe(minifyCSS({ keepSpecialComments: '*', keepBreaks: '*'}))
    .pipe(concat('bundle_admin.css'))
    .pipe(gulp.dest('./css'));
});

gulp.task('watch', function () {
   gulp.watch(['./js/main.js'],['js']);
    gulp.watch(['./js/admin.js'],['js_admin']);
   gulp.watch(['./css/main.css'],['css']);
   gulp.watch(['./css/admin.css'],['css_admin']);
   
});

gulp.task('default', [ 'js','js_admin','css','css_admin', 'watch' ]);
