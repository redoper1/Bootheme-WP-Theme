let gulp = require('gulp');
let sass = require('gulp-sass');
let cleanCSS = require('gulp-clean-css');
let sourcemaps = require('gulp-sourcemaps');
let autoprefixer = require('gulp-autoprefixer');
let concat = require('gulp-concat-multi');
let uglify = require('gulp-uglify-es').default;
var rename = require('gulp-rename');

gulp.task('styles', function () {
    return gulp.src('./scss/style.scss')
        .pipe(sourcemaps.init())
        .pipe(sass().on('error', sass.logError))
        .pipe(autoprefixer())
        .pipe(sourcemaps.write())
        .pipe(gulp.dest('.'));
});

gulp.task('minifycss', function () {
    return gulp.src('./style.css')
        .pipe(cleanCSS({restructuring: false}))
        .pipe(rename({
            suffix: '.min'
        }))
        .pipe(gulp.dest('.'));
});


gulp.task('scripts', function () {
    return concat({
        'scripts-head.js': ['./js/head/**/*.js', './js/head/*.js'],
        'scripts.js': ['./node_modules/bootstrap/dist/js/bootstrap.bundle.js', './node_modules/@fortawesome/fontawesome-free/js/all.min.js', './js/footer/**/*.js'],
    })
        .pipe(gulp.dest('./js'));
});

gulp.task('minifyjs', function () {
    return gulp.src([
        './js/scripts-head.js',
        './js/scripts.js'], { allowEmpty: true })
        .pipe(uglify())
        .pipe(rename({
            suffix: '.min'
        }))
        .pipe(gulp.dest('./js'));
});

gulp.task('watch', function () {
    gulp.watch(['./scss/**/*.scss', './scss/*.scss'], gulp.parallel('styles'));
    gulp.watch('./js/**/*.js', gulp.parallel('scripts'));
});


gulp.task('default', gulp.parallel('styles', 'scripts'));

gulp.task('build', gulp.series(
    gulp.parallel('styles', 'scripts'),
    gulp.parallel('minifycss', 'minifyjs'))
);

gulp.task('watch-build', function () {
    gulp.watch(['./scss/**/*.scss', './scss/*.scss'], gulp.series('styles', 'minifycss'));
    gulp.watch('./js/**/*.js', gulp.series('scripts', 'minifyjs'));
});