// Reload trình duyệt with gulp
var gulp        = require('gulp'),
	browserSync = require('browser-sync'),
	reload      = browserSync.reload;

//var scss        = require('gulp-sass');

// Variable config
var url         = "http://dinosa.app/";

/*
gulp.task('scss', function () {
	return gulp.src('admin/scss/style.scss')
		.pipe(scss()) // scss -> css
		.pipe(gulp.dest('admin/css'));
});
*/

gulp.task('watch', function () {

	var reloadFile = ['**/**/*.css',
					  '**/**/*.php',
					 ];
	//var scssFile = 'admin/scss/style.scss';

	//gulp.watch(scssFile, ['scss']);
	browserSync({
		proxy  : url,
		online : true,
		port   : 8080
	});

	gulp.watch(reloadFile, reload);
});
