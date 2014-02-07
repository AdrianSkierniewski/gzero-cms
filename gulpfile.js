var gulp = require('gulp'),
    path = require('path'),
    less = require('gulp-less'),
    sass = require('gulp-ruby-sass'),
    coffee = require('gulp-coffee'),
//    rename = require('gulp-rename'),
    watch = require('gulp-watch'),
    plumber = require('gulp-plumber'),
    notify = require('gulp-notify'),
    autoprefixer = require('gulp-autoprefixer'),
    minifycss = require('gulp-minify-css'),
    clean = require('gulp-clean'),

    paths = {
        scripts: [
            'app/assets/less/',
            'app/assets/sass/',
            'app/assets/coffee/'
        ]
    };

// default task watches sass files
gulp.task('default', function () {
    gulp.watch(path.join(paths.scripts[1], '*.scss'), ['sass']);
});

// less compilation task
gulp.task('less', function () {
    return gulp.src(path.join(paths.scripts[0], 'main.less'))
        .pipe(plumber())
        .pipe(less({
            paths: [path.join(paths.scripts[0], '*.less')]
        }))
        .on('error', notify.onError())
        .pipe(autoprefixer('last 3 versions', 'ie 11'))
        .pipe(minifycss())
        .pipe(gulp.dest('./public/css/'))
        .pipe(notify({
            title: "Gulp - Less",
            message: "Less sources has been compiled!"
        }));
});

// less files observer
gulp.task('watch-less', ['less'], function () {
    gulp.watch(path.join(paths.scripts[0], '*.less'), ['less']);
});

// sass compilation task
gulp.task('sass', function () {
    return gulp.src(path.join(paths.scripts[1], 'main.scss'))
        .pipe(plumber())
        .pipe(sass({
            loadPath: [path.join(paths.scripts[1], 'bootstrap/stylesheets/')],
            style: 'compressed'
        }))
        .on('error', notify.onError())
        .pipe(gulp.dest('./public/css/'))
        .pipe(notify({
            title: "Gulp - Sass",
            message: "Sass sources has been compiled!"
        }));
});

// sass files observer
gulp.task('watch-sass', ['sass'], function () {
    gulp.watch(path.join(paths.scripts[1], '*.scss'), ['sass']);
});

// coffee script compilation task
gulp.task('coffee', function () {
    return gulp.src(path.join(paths.scripts[2], 'main.coffee'))
        .pipe(coffee({bare: true}))
        .on('error', notify.onError())
        .pipe(gulp.dest('./public/js/'))
        .pipe(notify({
            title: "Gulp - Coffee",
            message: "Coffee sources has been compiled!"
        }));
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
