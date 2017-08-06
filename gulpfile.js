// LƯU TRỮ TẤT CẢ CÁC CẤU HÌNH CỦA GULP
// author: Nguyễn Đức Hoàng
// ************************************
// Chia làm 2 phần:
//   1. Quy trình phát triển.
//   2. Quy trình tối ưu.
// ************************************
// 1. Quy trình phát triển: 
//   1.1, Preprocessor Sass -> css
//   1.2, Reloading trình duyệt khi bất cứ file nào được lưu [html, scss, js]
// ************************************
// 2. Quy trình tối ưu:
//   2.1, Minify css
//   2.2, Minify javascirpt
//   2.3, Tối ưu image
//   -> Quy trình này cũng chạy tự động khi có file|dir thay đổi tương ứng
// ************************************
// Cấu trúc dir dự án nên chia làm 2 phần:
// 1. app || develope -> Thư mục project dành cho mục đích phát triển project
// 2. dist || product -> Code chuẩn đã minify, tối ưu hóa. dir project này
// triển khai trực tiếp trên server.

// Require thư viện thư viện 
var gulp        = require('gulp'),
	sass        = require('gulp-sass'),
	browserSync = require('browser-sync'),
	reload      = browserSync.reload,
	uglify      = require('gulp-uglify'),
	cssnano     = require('gulp-cssnano'),
	imagemin    = require('gulp-imagemin'),
	rename      = require('gulp-rename'),
	cache       = require('gulp-cache'),
	del         = require('del');

// Config
var url         = "http://dinosa.app",
	sassFile    = "**/**/*.scss",
	sassSrc     = "build/scss/main.scss",
	sassToCss   = "dist/css",
	reloadFile  = [
		"**/**/*.blade.html",
		"**/**/*.js",
		"**/**/*.php",
		"**/**/*.css"
	];

// Converts Sass to Css with gulp-sass
gulp.task('sass', function(){
	return gulp.src(sassSrc)
			   .pipe(sass().on('error', sass.logError))
		       .pipe(gulp.dest(sassToCss));
});

gulp.task('browser-sync', function () {
	// Khởi tạo một sever
	browserSync.init({
		proxy: url,
   		online: true,
   		port:8080
	});
});

gulp.task("watch", ['sass'], function () {
	gulp.watch(sassFile, ['sass']);
	//gulp.watch(reloadFile, reload);
});