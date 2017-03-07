var gulp = require('gulp');
var $ = require('gulp-load-plugins')();
var browserSync = require('browser-sync').create();

var sassPaths = [
	'assets/components/foundation-sites/scss',
	'assets/components/motion-ui/src'
];

gulp.task('sass', function () {
	return gulp.src('assets/scss/app.scss')
		.pipe($.sass({
			includePaths: sassPaths,
			outputStyle: 'compressed' // if css compressed **file size**
		})
		.on('error', $.sass.logError))
		.pipe($.autoprefixer({
			browsers: ['last 2 versions', 'ie >= 9']
		}))
		.pipe(gulp.dest('assets/css'));
});

// Browser-Sync watch files and inject changes
gulp.task('browsersync', function () {
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

gulp.task('default', ['sass'], function () {
	gulp.watch(['assets/scss/**/*.scss'], ['sass']);
});
