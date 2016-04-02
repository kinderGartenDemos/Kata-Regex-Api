var gulp    = require('gulp');
var phpunit = require('gulp-phpunit');
 
gulp.task('phpunit', function() {
	gulp.src('app/*').pipe(phpunit());
});

gulp.task('default', function() {
	gulp.watch('**/*.php', ['phpunit']);
});