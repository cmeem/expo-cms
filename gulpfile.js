var gulp = require("gulp");
var elixir = require("laravel-elixir");
gulp.task("default", function () {
    elixir(function (mix) {
        mix.js("resources/js/app.js", "public/js")
            .sass("resources/sass/app.scss", "public/css")
            .sourceMaps();
    });
});
