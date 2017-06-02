/**
 * Created by Nicolas on 7/05/2017.
 */
var gulp = require('gulp'),
    minify = require('gulp-minify'),
    cleanCSS = require('gulp-clean-css');

gulp.task('default', function() {
    gulp.start('jsminify','cssminify');
});

gulp.task('jsminify', function(){
    return gulp.src('js/*.js')
        .pipe(minify({
            ext:{
                src: '-debug.js',
                min:'.min.js'
            },
            exclude: ['tasks'],
            ignoreFiles: ['.combo.js', '-min.js', 'slideout.min.js', 'jquery.slides.min.js']
        }))
        .pipe(gulp.dest('dist'))
})

gulp.task('cssminify', function() {
    return gulp.src('css/*.css')
        .pipe(cleanCSS({
            compatibility: 'ie9',
            rebaseTo: "css"
        }))
        .pipe(gulp.dest('dist'));
});
