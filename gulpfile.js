/* jshint node:true */

var gulp = require('gulp');
var gutil = require('gulp-util');
var tar = require('gulp-tar');
var gzip = require('gulp-gzip');
var es = require('event-stream');
var livereload = require('gulp-livereload');
var lr = require('tiny-lr');
var server = lr();
server.listen(35729);

var htmlDir = 'public/';
var buildDir = 'mobile_build/';

gulp.task('html', function () {
  return gulp.src(htmlDir + '/**/*.html')
    .pipe(livereload(server));
});

gulp.task('watch', function () {
  gulp.watch(htmlDir + '/**/*.html', ['html']);
});

function appStream () {
  return gulp.src(['js/*.js',
                   'css/*.css',
                   'partials/*.html',
                   'templates/*.html',
                   'img/*.*',
                   'index.html',
                   '!lib/**'], {
    cwd: 'public/**'
  });
}

function libStream () {
  return gulp.src(['lib/angular/angular.min.js',
                   'lib/angular-animate/angular-animate.min.js',
                   'lib/angular-local-storage/angular-local-storage.min.js',
                   'lib/angular-resource/angular-resource.min.js',
                   'lib/angular-sanitize/angular-sanitize.min.js',
                   'lib/angular-ui-router/release/angular-ui-router.min.js',
                   'lib/ionic/js/ionic.min.js',
                   'lib/ionic/js/ionic-angular.min.js',
                   'lib/ionic/css/*.css',
                   'lib/ionic/fonts/*.*',
                   'lib/lodash/dist/lodash.min.js'], {
    cwd: 'public/**'
  });
}

gulp.task('dist', function(){
  return es.merge(appStream(), libStream())
  .pipe(tar('app.tar'))
  .pipe(gzip())
  .pipe(gulp.dest(''));
});

gulp.task('default', ['watch']);
gulp.task('build', ['build-app', 'build-lib']);