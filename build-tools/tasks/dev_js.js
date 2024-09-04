<<<<<<< HEAD
const { src, dest } = require("gulp");
const uglify = require("gulp-uglify-es").default;
const concat = require("gulp-concat");
const map = require("gulp-sourcemaps");
const bs = require("browser-sync");

module.exports = function dev_js() {
  return src("src/components/**/*.js")
    .pipe(map.init())
    .pipe(uglify())
    .pipe(concat("main.min.js"))
    .pipe(map.write("../sourcemaps"))
    .pipe(dest("../themes/kamkardan/js/"))
    .pipe(bs.stream());
};
=======
const { src, dest } = require("gulp");
const uglify = require("gulp-uglify-es").default;
const concat = require("gulp-concat");
const map = require("gulp-sourcemaps");
const bs = require("browser-sync");

module.exports = function dev_js() {
  return src("src/components/**/*.js")
    .pipe(map.init())
    .pipe(uglify())
    .pipe(concat("main.min.js"))
    .pipe(map.write("../sourcemaps"))
    .pipe(dest("../themes/kamkardan/js/"))
    .pipe(bs.stream());
};
>>>>>>> 6792cb3554322df4017191e382c2ca5918daba8f
