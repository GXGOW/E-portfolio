const gulp = require('gulp');
const ignore = require('gulp-ignore');
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
const exec = require('gulp-exec');
const merge = require('merge-stream');

const DEST = 'build/';

gulp.task('default', ['js-watch','watch-sass','minify-watch']);

// Browserify options
var customOpts = {
    entries: ['js/functions.js','js/form.js','js/trump.js'],
    debug: true
};
var opts = assign({}, watchify.args, customOpts);
var b = watchify(browserify(opts));

gulp.task('js-watch', bundle); // so you can run `gulp js` to build the file
b.on('update', bundle); // on any dep update, runs the bundler
b.on('log', gutil.log); // output build logs to terminal

function bundle() {
    return b.bundle()
    // log errors if they happen
        .on('error', gutil.log.bind(gutil, 'Browserify Error'))
        .pipe(source('functions.min.js'))
        // optional, remove if you don't need to buffer file contents
        .pipe(buffer())
        // optional, remove if you dont want sourcemaps
        //.pipe(sourcemaps.init({loadMaps: true})) // loads map from browserify file
        // Add transformation tasks to the pipeline here.
        .pipe(uglifyjs())
        .on('error', function (err) {
            gutil.log(gutil.colors.red('[Error]'), err.toString());
        })
        .pipe(sourcemaps.write('./')) // writes .map file
        .pipe(gulp.dest(DEST));
}

gulp.task('minify-css', () =>
    gulp.src('css/*.css')
        .pipe(cleanCSS({compatibility: 'ie8'}))
        .pipe(rename({ extname: '.min.css' }))
        .pipe(gulp.dest(DEST))
);

gulp.task('sass', () =>
        sass('css/styles.scss')
        .on('error', gutil.log.bind(gutil, 'Sass Error'))
        .pipe(gulp.dest('css/'))
        .pipe(filter('**/*.css'))

);

gulp.task('watch-sass', () =>
    gulp.watch('css/**/*.scss', ['sass'])
);

gulp.task('minify-watch', () =>
    gulp.watch('css/**/*.css', ['minify-css'])
)

gulp.task('node-css', () => {
        var nodes = gulp.src(['node_modules/reset-css/reset.css', 'node_modules/css-ripple-effect/dist/ripple.min.css'])
            .pipe(gulp.dest(DEST));
        var fa = gulp.src('node_modules/font-awesome/*/*')
            .pipe(gulp.dest(DEST + '/font-awesome'))
        merge(nodes,fa);
})