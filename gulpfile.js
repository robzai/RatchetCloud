var gulp = require('gulp');
var sass = require('gulp-sass');

// Bootstrap scss source
var bootstrapSass = {
        in: './node_modules/bootstrap-sass/'
    };
// Bootstrap fonts source
var fonts = {
        in: [bootstrapSass.in + 'assets/fonts/**/*'],
        out: 'fonts/'
    };
// Our scss source folder: .scss files
var scss = {
    in:    'scss/style.scss',
    out:   'css/',
    watch: 'scss/**/*.scss',
    sassOpts: {
        outputStyle: 'nested',
        precison: 3,
        errLogToConsole: true,
        includePaths: [bootstrapSass.in + 'assets/stylesheets']
    }
};
// copy bootstrap required fonts to dest
gulp.task('fonts', function () {
    return gulp
        .src(fonts.in)
        .pipe(gulp.dest(fonts.out));
});
// compile scss, before executing sass task gulp will automatically run fonts task firstly.
gulp.task('sass', ['fonts'], function () {
    return gulp.src(scss.in)
        .pipe(sass(scss.sassOpts))
        .pipe(gulp.dest(scss.out));
});
// default task
gulp.task('default', ['sass'], function () {
     gulp.watch(scss.watch, ['sass']);
});