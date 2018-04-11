var gulp        = require('gulp'),
		sass        = require('gulp-sass');
		browserSync = require('browser-sync')

gulp.task('hello', function() {
	console.log("hello");
});

gulp.task('sass', function() {
	return gulp.src(['app/sass/**/*.sass','app/sass/**/*.scss'])
	.pipe(sass({outputStyle: 'expanded'}).on('error', sass.logError))
	.pipe(gulp.dest('app/css'))
	.pipe(browserSync.reload({stream: true}))
});

gulp.task('browser-sync', function() {
	browserSync({
		server: { baseDir: 'app' }
	});
});

gulp.task('watch', ['browser-sync', 'sass'], function() {
	gulp.watch(['app/sass/**/*.sass','app/sass/**/*.scss'], ['sass'])
	gulp.watch('app/*.html', browserSync.reload);
	gulp.watch('app/js/**/*.js', browserSync.reload);
});