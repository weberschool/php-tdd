var gulp = require('gulp');
var phpspec = require('gulp-phpspec');
var notify = require('gulp-notify');

gulp.task('test', function() {
    var options = { verbose: 'v', notify: true, clear: true, formatter: 'pretty' };
    gulp.src('spec/**/*.php')
        .pipe(phpspec('./bin/phpspec run', options))
        .on('error', notify.onError({
            title: 'Crap',
            message: 'Your tests failed!',
            icon: __dirname + '/node_modules/gulp-phpspec/assets/test-fail.jpeg'
        }))
        .pipe(notify({
            title: 'Success',
            message: 'All tests have returned green!',
            icon: __dirname + '/node_modules/gulp-phpspec/assets/test-pass.jpeg'
        }));
});

gulp.task('watch', function() {
    gulp.watch(['spec/**/*.php', 'src/**/*.php'], ['test']);
});

gulp.task('default', ['test', 'watch']);