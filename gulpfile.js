const gulp = require('gulp');
const rename = require('gulp-rename');
const gutil = require('gulp-util');
const uglifyjs = require('gulp-uglify');
const cleanCSS = require('gulp-clean-css');
const browserify = require('browserify');
const assign = require('lodash.assign');
const watchify = require('watchify');
const source = require('vinyl-source-stream');
const sourcemaps = require('gulp-sourcemaps');
const buffer = require('vinyl-buffer');
const sass = require('gulp-ruby-sass');
const filter = require('gulp-filter');

const DEST = 'build/';

gulp.task('default', ['watch-sass', 'bundle']);

// Browserify JS + CSS

const params = {
    entries: ['js/css.js', 'js/functions.js', 'js/form.js'],
    debug: true,
    global: true,
    transform: [
        ['browserify-css', {
            rebaseUrls: true,
            rootDir: '.'
        }]
    ],
};
const opts = assign({}, watchify.args, params);
const bundler = watchify(browserify(opts));

gulp.task('bundle', bundle);
bundler.on('update', bundle);
bundler.on('log', gutil.log);

function bundle() {
    return bundler.bundle()
        .on('error', gutil.log.bind(gutil, 'Browserify Error'))
        .pipe(source('functions.min.js'))
        .pipe(buffer())
        // Add transformation tasks to the pipeline here.
        .pipe(uglifyjs())
        .on('error', function(err) {
            gutil.log(gutil.colors.red('[Error]'), err.toString());
        })
        .pipe(sourcemaps.write('./')) // writes .map file
        .pipe(gulp.dest(DEST));
}

gulp.task('sass', () =>
    sass('css/styles.scss')
    .on('error', gutil.log.bind(gutil, 'Sass Error'))
    .pipe(gulp.dest('css/'))
    .pipe(filter('**/*.css'))

);

gulp.task('watch-sass', () =>
    gulp.watch('css/**/*.scss', ['sass'])
);