const bs = require("browser-sync");

module.exports = function bs_html() {
  bs.init({
    server: {
      baseDir: "../theme/kamkardan/",
      host: "localhost:8080/",
    },
    callbacks: {
      ready: function (err, bs) {
        bs.addMiddleware("*", function (req, res) {
          res.writeHead(302, {
            location: "404.html",
          });
          res.end("Redirecting!");
        });
      },
    },
    browser: "chrome",
    logPrefix: "BS-HTML:",
    logLevel: "info",
    logConnections: true,
    logFileChanges: true,
    open: true,
  });
};
