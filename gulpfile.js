/* jshint node:true */

// Node modules
var request = require('request');
var fs = require('fs');
var es = require('event-stream');
var Q = require('q');
var dotenv = require('dotenv');
dotenv.load();

// Gulp plugins
var gulp = require('gulp');
var gutil = require('gulp-util');
var tar = require('gulp-tar');
var gzip = require('gulp-gzip');
var clean = require('gulp-clean');

// LiveReload
var livereload = require('gulp-livereload');
var lr = require('tiny-lr');
var server = lr();
server.listen(35729);

var htmlDir = 'public/';

gulp.task('html', function () {
  return gulp.src(htmlDir + '/**/*.html')
    .pipe(livereload(server));
});

gulp.task('watch', function () {
  gulp.watch(htmlDir + '/**/*.html', ['html']);
});

function appStream() {
  return gulp.src(['js/*.js',
                   'css/*.css',
                   'partials/*.html',
                   'templates/*.html',
                   'img/*.*',
                   'index.html',
                   'res/**/*.png',
                   'config.xml',
                   '!vendor/**'], {
    cwd: './public/**'
  });
}

function libStream() {
  return gulp.src(['vendor/angular/angular.min.js',
                   'vendor/angular-animate/angular-animate.min.js',
                   'vendor/angular-local-storage/angular-local-storage.min.js',
                   'vendor/angular-resource/angular-resource.min.js',
                   'vendor/angular-sanitize/angular-sanitize.min.js',
                   'vendor/angular-ui-router/release/angular-ui-router.min.js',
                   'vendor/ionic/release/js/ionic.min.js',
                   'vendor/ionic/release/js/ionic-angular.min.js',
                   'vendor/ionic/release/css/*.css',
                   'vendor/ionic/release/fonts/*.*',
                   'vendor/angular-toastr/dist/*.*',
                   'vendor/lodash/dist/lodash.min.js'], {
    cwd: './public/**'
  });
}

gulp.task('build', function () {
  return es.merge(appStream(), libStream())
    .pipe(tar('app.tar'))
    .pipe(gzip())
    .pipe(gulp.dest('./tmp'));
});

gulp.task('upload', ['build'], function (cb) {
  var url = 'https://build.phonegap.com/api/v1/apps/773505';
  var qs = {
    auth_token: process.env.PHONEGAP_BUILD_TOKEN
  };

  function callback(error, response, body) {
    var err = JSON.parse(body).error;
    if (Object.keys(err).length === 0) {
      cb();
    } else {
      cb(err);
    }
  }

  request.put({
    url: url,
    qs: qs
  }, callback)
    .form().append("file", fs.createReadStream('./tmp/app.tar.gz'));

  gulp.src('./tmp', {
    read: false
  })
    .pipe(clean());
});

gulp.task('getApk', function () {
  var url = 'https://build.phonegap.com/apps/773505/download/android';
  var deferred = Q.defer();

  function callback(error, response) {
    if (response.statusCode != 200) {
      deferred.reject("ERROR");
    }
  }
  request.get(url, callback)
    .pipe(fs.createWriteStream('./app.apk').on('finish', function () {
      deferred.resolve();
    }));

  return deferred.promise;

});

gulp.task('default', ['watch']);
