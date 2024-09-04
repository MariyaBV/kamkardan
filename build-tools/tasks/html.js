<<<<<<< HEAD
const { src, dest } = require("gulp");
const include = require("gulp-file-include");
const bs = require("browser-sync");

module.exports = function html() {
  return src(["src/**/*.html", "!src/components/**/*.html"])
    .pipe(include())
    .pipe(dest("../themes/kamkardan"))
    .pipe(bs.stream());
};
=======
const { src, dest } = require("gulp");
const include = require("gulp-file-include");
const bs = require("browser-sync");

module.exports = function html() {
  return src(["src/**/*.html", "!src/components/**/*.html"])
    .pipe(include())
    .pipe(dest("../themes/kamkardan"))
    .pipe(bs.stream());
};
>>>>>>> 6792cb3554322df4017191e382c2ca5918daba8f
