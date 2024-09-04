<<<<<<< HEAD
const { watch, parallel, series } = require("gulp");

module.exports = function watching() {
  watch("src/**/*.html", parallel("html"));
  watch("src/**/*.scss", parallel("style"));
  watch("src/**/*.js", parallel("dev_js"));
};
=======
const { watch, parallel, series } = require("gulp");

module.exports = function watching() {
  watch("src/**/*.html", parallel("html"));
  watch("src/**/*.scss", parallel("style"));
  watch("src/**/*.js", parallel("dev_js"));
};
>>>>>>> 6792cb3554322df4017191e382c2ca5918daba8f
