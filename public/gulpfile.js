var syntax        = 'scss'; // Syntax: sass or scss;

var gulp          = require('gulp'),
		gutil         = require('gulp-util' ),
		sass          = require('gulp-sass'),
		concat        = require('gulp-concat'),
		uglify        = require('gulp-uglify'),
		cleancss      = require('gulp-clean-css'),
		rename        = require('gulp-rename'),
		autoprefixer  = require('gulp-autoprefixer'),
		notify        = require("gulp-notify");

gulp.task('styles', function() {
	return gulp.src('assets/'+syntax+'/**/*.'+syntax+'')
	.pipe(sass({ outputStyle: 'expanded' }).on("error", notify.onError()))
	.pipe(rename({ suffix: '.min', prefix : '' }))
	.pipe(autoprefixer(['last 15 versions']))
	.pipe(cleancss( {level: { 1: { specialComments: 0 } } })) // Opt., comment out when debugging
	.pipe(gulp.dest('assets/css'))
});

gulp.task('js', function() {
	return gulp.src([
    'node_modules/jquery/dist/jquery.min.js',
    'node_modules/vue/dist/vue.js',
    'node_modules/select2/dist/js/select2.js',
    'node_modules/axios/dist/axios.js',
    'node_modules/bootstrap/dist/js/bootstrap.bundle.min.js',
    'node_modules/owl.carousel/dist/owl.carousel.min.js',
    'node_modules/lity/dist/lity.min.js',
		'assets/js/common.js', // Always at the end
		])
	.pipe(concat('scripts.min.js'))
	// .pipe(uglify()) // Mifify js (opt.)
	.pipe(gulp.dest('assets/js'))
});

gulp.task('watch', ['styles', 'js'], function() {
	gulp.watch('assets/'+syntax+'/**/*.'+syntax+'', ['styles']);
	gulp.watch(['libs/**/*.js', 'assets/js/common.js'], ['js']);
});

gulp.task('default', ['watch']);
