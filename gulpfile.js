var gulp = require('gulp'),
    $ = require('gulp-load-plugins')(),
    browserSync = require('browser-sync').create(),
    babel = require('gulp-babel'),
    uglify = require('gulp-uglify'),
    concat = require('gulp-concat'),
    rename = require('gulp-rename');

var sassPaths = [
    'assets/components/foundation-sites/scss',
    'assets/components/motion-ui/src'
];

// Process SCSS
gulp.task('sass', function () {
    return gulp.src(['assets/scss/app.scss', 'assets/scss/editor.scss'])
        .pipe($.sass({
            includePaths: sassPaths,
            outputStyle: 'compressed'
        })
            .on('error', $.sass.logError))
        .pipe($.autoprefixer({
            browsers: ['last 2 versions', 'ie >= 11']
        }))
        .pipe(gulp.dest('assets/css'));
});


// JSHint, concat, and minify Foundation JavaScript
gulp.task('foundation-js', function () {
    return gulp.src([

        // Include what-input
        // './assets/components/what-input/dist/what-input.js',

        // Foundation core - needed if you want to use any of the components below
        './assets/components/foundation-sites/js/foundation.core.js',
        './assets/components/foundation-sites/js/foundation.util.*.js',

        // Pick the components you need in your project
        // './assets/components/foundation-sites/js/foundation.abide.js',
        './assets/components/foundation-sites/js/foundation.accordion.js',
        './assets/components/foundation-sites/js/foundation.accordionMenu.js',
        // './assets/components/foundation-sites/js/foundation.drilldown.js',
        // './assets/components/foundation-sites/js/foundation.dropdown.js',
        // './assets/components/foundation-sites/js/foundation.dropdownMenu.js',
        './assets/components/foundation-sites/js/foundation.equalizer.js',
        // './assets/components/foundation-sites/js/foundation.interchange.js',
        // './assets/components/foundation-sites/js/foundation.magellan.js',
        // './assets/components/foundation-sites/js/foundation.offcanvas.js',
        './assets/components/foundation-sites/js/foundation.orbit.js',
        // './assets/components/foundation-sites/js/foundation.responsiveMenu.js',
        './assets/components/foundation-sites/js/foundation.responsiveToggle.js',
        './assets/components/foundation-sites/js/foundation.reveal.js',
        // './assets/components/foundation-sites/js/foundation.slider.js',
        // './assets/components/foundation-sites/js/foundation.sticky.js',
        // './assets/components/foundation-sites/js/foundation.tabs.js',
        // './assets/components/foundation-sites/js/foundation.toggler.js',
        // './assets/components/foundation-sites/js/foundation.tooltip.js',
    ])
        .pipe(babel({
            presets: ['es2015'],
            compact: true
        }))
        .pipe(concat('foundation.js'))
        .pipe(gulp.dest('./assets/js'))
});

// JSHint, concat, and minify calendar JavaScript
gulp.task('calendar-js', function () {
    return gulp.src([
        './assets/components/moment/min/moment.min.js',
        './assets/components/fullcalendar/dist/fullcalendar.min.js',
    ])
        .pipe(concat('calendar.min.js'))
        .pipe(gulp.dest('./assets/js'))
});

// JSHint, concat, and minify CHoice JavaScript
gulp.task('choice-js', function () {
    return gulp.src([
        './assets/js/w3cie.choice.js',
    ])
        .pipe(concat('w3cie.choice.min.js'))
        .pipe(gulp.dest('./assets/js'))
});

// JSHint, concat, and minify JavaScript
gulp.task('site-js', ['foundation-js', 'calendar-js', 'choice-js'], function () {
    return gulp.src([

        // Grab your custom scripts
        './assets/js/foundation.js',
        './assets/components/motion-ui/motion-ui.js',
        './assets/components/magnific-popup/dist/jquery.magnific-popup.js',
        './assets/js/app.js',

    ])
        .pipe(concat('scripts.js'))
        .pipe(gulp.dest('./assets/js'))
        .pipe(rename({suffix: '.min'}))
        .pipe(uglify())
        .pipe(gulp.dest('./assets/js'))
});

// Browser-Sync watch files and inject changes
gulp.task('browsersync', function () {
    // Watch files
    var files = [
        'assets/css/*.css',
        'assets/js/*.js',
        '**/*.html',
        '**/*.php',
        'assets/images/**/*.{png,jpg,jpeg,gif,svg,webp}',
    ];

    browserSync.init(files, {
        proxy: "wisvch.dev",
        notify: false
    });

    gulp.watch(['assets/scss/**/*.scss'], ['sass']);
    gulp.watch(['assets/js/app.js'], ['site-js']);
    gulp.watch(['assets/js/calendar.js'], ['calendar-js']);
    gulp.watch(['assets/js/w3cie.choice.js'], ['choice-js']);

});

gulp.task('default', ['sass', 'site-js'], function () {
    gulp.watch(['assets/scss/**/*.scss'], ['sass']);
    gulp.watch(['assets/js/app.js'], ['site-js']);
    gulp.watch(['assets/js/calendar.js'], ['calendar-js']);
    gulp.watch(['assets/js/w3cie.choice.js'], ['choice-js']);
});
