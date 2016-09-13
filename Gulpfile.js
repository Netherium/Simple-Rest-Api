var gulp = require("gulp");
var shell = require("gulp-shell");

gulp.task("Start Server", shell.task("php bin/console server:run"));
gulp.task("Stop Server", shell.task("php bin/console server:stop"));
gulp.task("cache:clear", shell.task("php bin/console cache:clear --env=prod && php bin/console cache:clear --env=dev"));
gulp.task("doctrine:cache:clear", shell.task("php bin/console doctrine:cache:clear-metadata && php bin/console doctrine:cache:clear-result && php bin/console doctrine:cache:clear-query"));

gulp.task("doctrine:mapping:import", shell.task("php bin/console doctrine:mapping:import --force AppBundle xml"));
gulp.task("doctrine:mapping:convert", shell.task("php bin/console doctrine:mapping:convert annotation ./src"));
gulp.task("doctrine:generate:entities", shell.task("php bin/console doctrine:generate:entities AppBundle"));
gulp.task("doctrine:schema:validate", shell.task("php bin/console doctrine:schema:validate"));
gulp.task("doctrine:schema:update --dump-sql", shell.task("php bin/console doctrine:schema:update --dump-sql"));
gulp.task("doctrine:schema:update --force", shell.task("php bin/console doctrine:schema:update --force"));
gulp.task("doctrine:fixtures:load", shell.task("php bin/console doctrine:fixtures:load"));
gulp.task("debug:route", shell.task("php bin/console debug:route"));