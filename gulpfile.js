var gulp = require('gulp'),
    path = require('path'),
    less = require('gulp-less'),
    sass = require('gulp-ruby-sass'),
    coffee = require('gulp-coffee'),
    watch = require('gulp-watch'),
    plumber = require('gulp-plumber'),
    notify = require('gulp-notify'),
    autoprefixer = require('gulp-autoprefixer'),
    minifycss = require('gulp-minify-css'),
    rename = require("gulp-rename"),
    clean = require('gulp-clean'),
    fs = require('fs'),
    gutil = require('gulp-util'),

    paths = {
        scripts: [
            'src/assets/less/',
            'src/assets/sass/',
            'src/assets/coffee/'
        ]
    };

/**
 *** DEFAULT GZERO CMS Gulp Tasks ***
 */

// default task watches sass files
gulp.task('default', ['sass'], function () {
    gulp.watch(path.join(paths.scripts[1], '*.scss'), ['sass']);
});

// less compilation task
gulp.task('less', function () {
    var filePath = path.join(paths.scripts[0], 'main.less');
    fs.exists(filePath, function (exists) {
        if (exists) {
            gulp.src(filePath)
                .pipe(plumber())
                .pipe(less({
                    paths: [path.join(paths.scripts[0], '*.less')]
                }))
                .on('error', notify.onError())
                .pipe(autoprefixer('last 3 versions', 'ie 11'))
                .pipe(minifycss())
                .pipe(rename('main.min.css'))
                .pipe(gulp.dest('./public/css/'))
                .pipe(notify({
                    title: "Gulp - Less",
                    message: "Less sources has been compiled!"
                }));
        } else {
            gutil.log('File ' + filePath + ' not found!');
        }
    });
});

// less files observer
gulp.task('watch-less', ['less'], function () {
    gulp.watch(path.join(paths.scripts[0], '*.less'), ['less']);
});

// sass compilation task
gulp.task('sass', function () {
    var filePath = path.join(paths.scripts[1], 'main.scss');
    fs.exists(filePath, function (exists) {
        if (exists) {
            gulp.src(filePath)
                .pipe(plumber())
                .pipe(sass({
                    loadPath: [path.join(paths.scripts[1], 'bootstrap/stylesheets')],
                    style: 'compressed'
                }))
                .on('error', notify.onError())
                .pipe(rename('main.min.css'))
                .pipe(gulp.dest('./public/css/'))
                .pipe(notify({
                    title: "Gulp - Sass",
                    message: "Sass sources has been compiled!"
                }));
        } else {
            gutil.log('File ' + filePath + ' not found!');
        }
    });
});

// sass files observer
gulp.task('watch-sass', ['sass'], function () {
    gulp.watch(path.join(paths.scripts[1], '*.scss'), ['sass']);
});

// coffee script compilation task
gulp.task('coffee', function () {
    var filePath = path.join(paths.scripts[2], 'main.coffee');
    fs.exists(filePath, function (exists) {
        if (exists) {
            gulp.src(filePath)
                .pipe(coffee({bare: true}))
                .on('error', notify.onError())
                .pipe(gulp.dest('./public/js/'))
                .pipe(notify({
                    title: "Gulp - Coffee",
                    message: "Coffee sources has been compiled!"
                }));
        } else {
            gutil.log('File ' + filePath + ' not found!');
        }
    });
});

// coffee script files observer
gulp.task('watch-coffee', ['coffee'], function () {
    gulp.watch(path.join(paths.scripts[2], '*.coffee'), ['coffee']);
});

// clean leftover files in project
gulp.task('clean', function () {
    return gulp.src(['.sass-cache', './public/css/*.scss'], {read: false})
        .pipe(clean());
});

/**
 *** END of DEFAULT GZERO CMS Gulp Tasks ***
 */
