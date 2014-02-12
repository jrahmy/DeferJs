/* jshint node: true  */
'use strict';

var gulp = require('gulp');
var gutil = require('gulp-util');
var exec = require('child_process').exec;

function namespace() {
    var directory = __dirname.split('/');
    while (directory.length > 2) {
        directory.shift();
    }

    return directory.join('/');
}

gulp.task('filesums', function () {
    exec('xfhelper hash ' + namespace());

    gutil.log(gutil.colors.green('Success! Filesums updated.'));
});

gulp.task('export', function () {
    exec('xfhelper export ' + namespace());

    gutil.log(gutil.colors.green('Success! Addon XML updated.'));
});

gulp.task('default', ['filesums', 'export']);
