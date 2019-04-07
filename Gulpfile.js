'use strict';

/*
---------------------------------------
I. Prerequisites
---------------------------------------
*/

const
  babel = require('gulp-babel'),
  browserSync = require('browser-sync').init,
  conf = require('./config'),
  connect = require('gulp-connect-php'),
  isLive = ((process.env.NODE_ENV || '').trim().toLowerCase() === 'production'),
  eslint = require('gulp-eslint'),
  favicons = require('gulp-favicons'),
  filter = require('gulp-filter'),
  gulp = require('gulp'),
  gulpif = require('gulp-if'),
  imagemin = require('gulp-imagemin'),
  minify = require('gulp-clean-css'),
  named = require('vinyl-named'),
  newer = require('gulp-newer'),
  prefix = require('gulp-autoprefixer'),
  rename = require('gulp-rename'),
  sass = require('gulp-sass'),
  size = require('gulp-size'),
  stylelint = require('gulp-stylelint'),
  svg = require('gulp-svgstore'),
  svgmin = require('gulp-svgmin'),
  uglify = require('gulp-uglify'),
  webpack = require('webpack-stream')
;


/*
---------------------------------------
II. Assets
---------------------------------------
*/


/*
 * 1. Styles
 *
 * `gulp lint:styles` - lints styles using stylelint (config under 'stylelint' in package.json)
 * `gulp make:styles` - compiles sass into css & minifies it (production)
*/

gulp.task('lint:styles', function() {
  return gulp.src([conf.src.styles + '/**/*.scss', '!' + conf.src.styles + '/vendor/**/*.scss'], {since: gulp.lastRun('lint:styles')})
    .pipe(newer(conf.dist.styles))
    // For more options, see http://stylelint.io/user-guide/example-config/
    .pipe(stylelint(conf.styles.linting))
    .pipe(gulpif(conf.styles.linting.fix == true, gulp.dest(conf.src.styles)))
  ;
});

gulp.task('make:styles', function() {
  return gulp.src(conf.src.styles + '/*.scss')
    .pipe(sass(conf.styles.sass).on('error', sass.logError))
    .pipe(prefix(conf.styles.prefix))
    .pipe(gulpif(isLive, minify()))
    .pipe(gulpif(isLive, rename({suffix: '.min'})))
    .pipe(size({gzip: true, showFiles: true}))
    .pipe(gulp.dest(conf.dist.styles))
    .pipe(browserSync.stream())
  ;
});

gulp.task('styles', gulp.series(
  'lint:styles',
  'make:styles'
));


/*
 * 2. Scripts
 *
 * `gulp lint:scripts` - lints javascript using eslint & caches results (config under eslintConfig in package.json)
 * `gulp make:scripts` - compiles / concatenates javascript & minifies it (production)
 *
 */

gulp.task('lint:scripts', function() {
  return gulp.src(conf.src.scripts + '/**/*.js', {since: gulp.lastRun('lint:scripts')})
    .pipe(eslint(conf.scripts.linting))
    .pipe(eslint.format());
});

gulp.task('make:scripts', function() {
  return gulp.src(conf.src.scripts + '/' + conf.scripts.input)
    .pipe(named())
    .pipe(webpack(conf.scripts.webpack))
    .pipe(babel({presets: ['env']}))
    .pipe(gulpif(isLive, uglify()))
    .pipe(gulpif(isLive, rename({suffix: '.min'})))
    .pipe(size({gzip: true, showFiles: true}))
    .pipe(gulp.dest(conf.dist.scripts))
    .pipe(browserSync.stream())
  ;
});

gulp.task('scripts', gulp.series(
  'lint:scripts',
  'make:scripts'
));


/*
 * 3. Images & Icons
 *
 * `gulp minify:images` - losslessly minifies images
 * `gulp compress:icons` - compresses SVG icons & combines them to a sprite
 */

gulp.task('compress:images', function() {
  const filetypes = conf.images.allowed.join(',');

  return gulp.src([conf.src.images + '/**/*.{' + filetypes + '}'])
    .pipe(newer(conf.dist.images))
    .pipe(imagemin(conf.images.minify))
    .pipe(size({showFiles: true}))
    .pipe(gulp.dest(conf.dist.images))
    .pipe(browserSync.stream())
  ;
});

gulp.task('combine:icons', function() {
  return gulp.src(conf.src.icons + '/**/*.svg')
    .pipe(newer(conf.dist.icons))
    .pipe(svgmin(conf.icons.minify))
    .pipe(svg({inlineSvg: conf.icons.inline})) // See https://github.com/w0rm/gulp-svgstore#options
    .pipe(rename(conf.icons.output))
    .pipe(gulp.dest(conf.dist.icons));
});

gulp.task('create:favicons', function(done) {
  const snippet = filter('**/' + conf.favicons.snippet, {restore: true});

  if (conf.favicons.enable) {
    return gulp.src(conf.src.images + '/' + conf.favicons.input)
      .pipe(favicons(conf.favicons.options))
      .pipe(snippet)
      .pipe(rename({extname: '.php'}))
      .pipe(snippet.restore)
      .pipe(gulp.dest(conf.src.images + '/favicons'));
  } else {
    done();
  }
});

gulp.task('images', gulp.series(
  gulp.parallel(
    'create:favicons',
    'combine:icons'
  ),
  'compress:images'
));


/*
 * 4. Fonts
 *
 * `gulp fonts`
 */

gulp.task('fonts', function() {
  return gulp.src(conf.src.fonts + '/**/*')
    .pipe(newer(conf.dist.fonts))
    .pipe(gulp.dest(conf.dist.fonts))
    .pipe(browserSync.stream())
  ;
});


/*
 * 5. Putting them all together
 *
 * `gulp build` - compiles & collects all assets simultaneously
 */

gulp.task('build', gulp.parallel(
  'styles',
  'scripts',
  'images',
  'fonts'
));


/*
---------------------------------------
III. Development / Deployment
---------------------------------------
*/


/*
 * 1. Development Server
 *
 * gulp server - starts a local development server, using php & live-reload via browsersync
 */

gulp.task('connect', function() {
  connect.server(conf.server);
});

gulp.task('browsersync', function() {
  browserSync.init(conf.browsersync);
});

gulp.task('server', gulp.parallel(
  'connect',
  'browsersync'
));


/*
 * 2. Monitoring
 *
 * `gulp watch` - watches for changes, recompiles & injects assets
 */

gulp.task('watch:styles', function() {
  gulp.watch(conf.src.styles + '/**/*.scss', gulp.series('styles'));
});

gulp.task('watch:scripts', function() {
  gulp.watch(conf.src.scripts + '/**/*.js', gulp.series('scripts'));
});

gulp.task('watch:images', function() {
  gulp.watch(conf.src.images + '/**/*', gulp.series('images'));
});

gulp.task('watch:fonts', function() {
  gulp.watch(conf.src.fonts + '/**/*', gulp.series('fonts'));
});

gulp.task('watch:code', function() {
  // https://github.com/BrowserSync/browser-sync/issues/711
  function reload(done) {
    browserSync.reload();
    done();
  }

  gulp.watch([
    'site/**/*.{php,yml}',
    'Gulpfile.js',
    'config.js',
  ], gulp.series(reload));
});

gulp.task('watch', gulp.parallel(
  'watch:styles',
  'watch:scripts',
  'watch:images',
  'watch:fonts',
  'watch:code'
));


/*
 * 3. Deployment
 *
 * `gulp deploy` - pushes site content onto a remote repository
 */

// gulp.task('deploy', function() {
//
// });


/*
---------------------------------------
IV. The best of all possible worlds
---------------------------------------
*/

gulp.task('default', gulp.series(
  'build',
  gulp.parallel(
    'server',
    'watch'
  )
));
