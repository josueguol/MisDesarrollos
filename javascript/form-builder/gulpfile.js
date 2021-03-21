var gulp = require('gulp'),
    sass = require('gulp-sass');
    rename = require('gulp-rename'),
    jshint = require('gulp-jshint'),
    concat = require('gulp-concat'),
    uglify = require('gulp-uglify');;

var config = {
	cssSrcDir: './css/src',
	jsSrcDir: './js/src',
    builDir: './build',
};

gulp.task('css', function() {
    return gulp.src(config.cssSrcDir + '/app.scss')
    .pipe(sass({
        includePaths: [config.cssSrcDir],
    }))
    .pipe(rename('formbuilder.css'))
    .pipe(gulp.dest(config.builDir + '/css'));
});

gulp.task('fonts', function() {
    return gulp.src(config.cssSrcDir + '/fonts/**/*')
    .pipe(gulp.dest(config.builDir + '/fonts'));
});

gulp.task('js', function() {
    gulp.src(config.jsSrcDir + '/**/**/*.js')
    .pipe(jshint())
    .pipe(jshint.reporter('default'))
    .pipe(concat('formbuilder.js'))
    //.pipe(uglify())
    .pipe(gulp.dest(config.builDir + '/js'))
});

gulp.task('default', ['css', 'fonts', 'js']);