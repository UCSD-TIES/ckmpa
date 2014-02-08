var gulp = require('gulp');
var gutil = require('gulp-util');
var notify = require('gulp-notify');
var sass = require('gulp-ruby-sass');
var autoprefix = require('gulp-autoprefixer');
var minifyCSS = require('gulp-minify-css')
var coffee = require('gulp-coffee');
var ls = require('gulp-livescript');
var livereload = require('gulp-livereload');
var lr = require('tiny-lr')
var server = lr();
server.listen(35729);

// Where do you store your Sass files?
var sassDir = 'app/assets/sass';
 
// Which directory should Sass compile to?
var targetCSSDir = 'public/css';
 
// Where do you store your CoffeeScript files?
var coffeeDir = 'app/assets/coffee';
var lsDir = 'app/assets/livescript';

// Which directory should CoffeeScript compile to?
var targetJSDir = 'app/assets/javascripts/mobile';
 
var htmlDir = 'public/';

// Compile Sass, autoprefix CSS3,
// and save to target CSS directory
gulp.task('css', function () {
    return gulp.src(sassDir + '/main.sass')
        .pipe(sass({ style: 'compressed' }).on('error', gutil.log))
        .pipe(autoprefix('last 10 version'))
        .pipe(gulp.dest(targetCSSDir))
        .pipe(notify('CSS minified'))
});
 
// // Handle CoffeeScript compilation
// gulp.task('js', function () {
//     return gulp.src(coffeeDir + '/**/*.coffee')
//         .pipe(coffee().on('error', gutil.log))
//         .pipe(gulp.dest(targetJSDir))
// });

gulp.task('js', function () {
    return gulp.src(lsDir + '/**/*.ls')
        .pipe(ls({bare: true}).on('error', gutil.log))
        .pipe(gulp.dest(targetJSDir))
});

gulp.task('html', function () {
    return gulp.src(htmlDir + '/**/*.html')
        .pipe(livereload(server));
})
 
 
// Keep an eye on Sass, Coffee, and PHP files for changes...
gulp.task('watch', function () {
    //gulp.watch(sassDir + '/**/*.sass', ['css']);
    //gulp.watch(coffeeDir + '/**/*.coffee', ['js']);
    gulp.watch(lsDir + '/**/*.ls', ['js']);
    gulp.watch(htmlDir + '/**/*.html', ['html']);
});
 
// What tasks does running gulp trigger?
gulp.task('default', ['js', 'watch']);