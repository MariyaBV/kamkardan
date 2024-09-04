<<<<<<< HEAD
const { src, dest } = require("gulp");
const uglify = require("gulp-uglify-es").default;
const babel = require("gulp-babel");
const concat = require("gulp-concat");

module.exports = function build_js() {
  return src("src/components/**/*.js")
    .pipe(uglify())
    .pipe(
      babel({
        presets: ["@babel/env"],
      })
    )
    .pipe(concat("main.min.js"))
    .pipe(dest("../themes/kamkardan/js/"));
};
=======
const { src, dest } = require("gulp");
const uglify = require("gulp-uglify-es").default;
const babel = require("gulp-babel");
const concat = require("gulp-concat");

module.exports = function build_js() {
  return src("src/components/**/*.js")
    .pipe(uglify())
    .pipe(
      babel({
        presets: ["@babel/env"],
      })
    )
    .pipe(concat("main.min.js"))
    .pipe(dest("../themes/kamkardan/js/"));
};
>>>>>>> 6792cb3554322df4017191e382c2ca5918daba8f
