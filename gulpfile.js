/********* GENERAL SETTINGS *********/

var paths = {
	js: './js/',
	jsdst: './js_dist/'
}

var files = {
	js: 'script.js',
	jsdst: 'script.dist.js'
}

var gulp 			= require('gulp'),
	browserify 	= require('browserify'),
	source 			= require('vinyl-source-stream'),
	gutil 			= require('gulp-util'),
	jshint 			= require('gulp-jshint'),
	uglify 			= require('gulp-uglify'),
	buffer 			= require('gulp-buffer'),
	sourcemaps	= require('gulp-sourcemaps'),
	compass 		= require('gulp-compass');

var pkg 			= require('./package.json');




/********* DEFAULT GULP FUNCTION + WATCHERS *********/

gulp.task('default', ['jsScripts','cssScripts'], function (){

	var jsWatcher = gulp.watch(paths.js+'**/*.js', ['jsScripts']);
	jsWatcher.on('change', function(event) {
		console.log('File ' + event.path + ' was ' + event.type + ', running js tasks...');
	});

	cssWatcher = gulp.watch('./_scss/*.scss', ['cssScripts'])
	cssWatcher.on('change', function(event) {
		console.log('File ' + event.path + ' was ' + event.type + ', running css tasks...');
	});

});


/********* JS FUNCTIONS *********/

gulp.task('jsScripts', ['jsLint'], function(){

	var bundler = browserify({
		entries: [paths.js+files.js], debug:true
	});

	return bundler.bundle()
		.on('error', function(err) {
			this.emit('end');
			gutil.log('Error:', gutil.colors.red(err.message));
			gutil.beep();
		})
		.pipe(source(files.jsdst))
		.pipe(buffer())
		.pipe(sourcemaps.init({loadMaps:true}))
		.pipe(uglify())
		.pipe(sourcemaps.write('./', {
			sourceRoot: '../'
		}))
		.pipe(gulp.dest(paths.jsdst))
});

gulp.task('jsLint', function(cb) {
  return gulp.src([paths.js+'**/*.js', '!./js/vendor/*.js'])
    .pipe(jshint())
    .pipe(jshint.reporter('jshint-stylish'));
    cb();
});




/********* CSS FUNCTION *********/

gulp.task('cssScripts', function (){
	return gulp.src('_scss/*.scss')
	.pipe(compass({
		config_file: './config.rb',
		css: 'css',
		sass: '_scss'
	}))
	.pipe(gulp.dest('./css/'));
});