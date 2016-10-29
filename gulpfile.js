var gulp = require('gulp');
var $    = require('gulp-load-plugins')();
var browserSync = require('browser-sync').create();

var sassPaths = [
  'vendor/foundation-sites/scss',
  'vendor/motion-ui/src'
];

gulp.task('sass', function() {
  return gulp.src('scss/app.scss')
    .pipe($.sass({
      includePaths: sassPaths,
      outputStyle: 'compressed' // if css compressed **file size**
    })
      .on('error', $.sass.logError))
    .pipe($.autoprefixer({
      browsers: ['last 2 versions', 'ie >= 9']
    }))
    .pipe(gulp.dest('css'));
});

// Browser-Sync watch files and inject changes
gulp.task('browsersync', function() {
	// Watch files
	var files = [
		'./css/*.css',
		'./js/*.js',
		'**/*.html',
		'assets/images/**/*.{png,jpg,gif,svg,webp}',
	];

	browserSync.init(files, {
		server: {
			baseDir: "./"
		},
		tunnel: "wisvch"
	});

	gulp.watch(['scss/**/*.scss'], ['sass']);

});

gulp.task('default', ['sass'], function() {
  gulp.watch(['scss/**/*.scss'], ['sass']);
});
