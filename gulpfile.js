const { src, dest, watch, parallel } = require('gulp')
const sass = require('gulp-sass')(require('sass'));
const sourcemaps = require('gulp-sourcemaps');

function css() {
    return src('src/scss/**/*.scss')
        .pipe(sourcemaps.init())
        .pipe(sass({style: 'compressed'}).on('error', sass.logError))
        .pipe(sourcemaps.write('.'))
        .pipe(dest('./public/build/css'));
}

function js() {
    return src('./src/js/**/*.js')
        .pipe(dest('./public/build/js'));
}

function watchArchivos() {
    watch('./src/scss/**/*.scss', css);
}

exports.css = css;
exports.js = js;
exports.default = parallel(css, js, watchArchivos);