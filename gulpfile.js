// Reload trình duyệt with gulp
var gulp        = require('gulp');
var browserSync = require('browser-sync');
var reload      = browserSync.reload;
//var scss        = require('gulp-sass');

// Variable config
var url         = "http://dinosa.app/";

gulp.task('browser-sync', function () {
	browserSync.init({
		proxy: url,
		//online: true,
		//port: 8080
	});
});

/*
gulp.task('scss', function () {
	return gulp.src('admin/scss/style.scss')
		.pipe(scss()) // scss -> css
		.pipe(gulp.dest('admin/css'));
});
*/

gulp.task('watch', ['browser-sync'], function () {
	var reloadFile = ['**/**/*.css',
					  '**/**/*.php',
					 ];
	//var scssFile = 'admin/scss/style.scss';

	//gulp.watch(scssFile, ['scss']);
	gulp.watch(reloadFile, reload);
});
